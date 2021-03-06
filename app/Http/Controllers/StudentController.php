<?php
/**
 * Created by PhpStorm.
 * User: presa
 * Date: 27/11/2018
 * Time: 09:00 PM
 */

namespace App\Http\Controllers;


use App\Http\Model\Document;
use App\Http\Model\Position;
use App\Http\Model\Process;
use App\Http\Model\ProcessHasDocument;
use App\Http\Model\ProcessHasUser;
use App\Http\Model\RevisionAlumno;
use App\Http\Model\Rol;
use App\Http\Model\State;
use App\Http\Model\Status;
use App\Http\Model\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpParser\Comment\Doc;
use Validator;

class StudentController extends Controller
{
    public function revision()
    {
        $alumno = Auth::user();
        return view('alumno.revision', [
            'alumno' => $alumno
        ]);
    }

    public function revisionPost(Request $request)
    {
        $rules = [
            'url' => 'required|mimes:doc,docx',
            'comments' => 'max:1000,',
        ];
        if (Auth::user()->documents()->count() === 0) {
            $rules['producto'] = 'required';
            $rules['name'] = 'required';
        }
        $validator = Validator::make(
            $request->all(),
            $rules,
            [
                'name.required' => 'El nombre del proyecto es requerido.',
                'producto.required' => 'Ingresa el la opción de titulación.',
                'url.required' => 'Ingresa el docuento de word.',
                'url.mimetypes' => 'Ingresa un archivo de word.',
                'comments.max' => 'Ingresa un comentario más pequeño',
            ]
        );
        $validator->validate();
        try {
            $alumno = Auth::user();
            $document = new Document();
            $no_document = $alumno->documents()->count() > 0 ? $alumno->documents->count() : 1;
            $document->no_document = $no_document;
            $document->comments = $request->get('comments');
            $document->fk_id_user = $alumno->id;
            $document->fk_id_status = Status::PENDIENTE;
            $transactionOk = $document->save();
            if ($transactionOk) {
                $fileOk = $request->hasFile('url') &&
                    $request->file('url')->isValid();
            }
            if ($fileOk) {
                $docUrl = $this->storeDocx(
                    $request->file('url'),
                    Auth::user()->id,
                    $document->no_document,
                    Auth::user()->full_name,
                    'version_'
                );
                $document->url = $docUrl;
                $transactionOk = $transactionOk && $document->save();
            }
            if ($transactionOk) {
                $created = false;
                if ($alumno->processHasUsers()->count() > 0) {
                    $process = Process::whereHas('hasUser', function ($q) use ($alumno) {
                        $q->where('fk_id_user', $alumno->id);
                    })->first();
                    $process->fk_id_state = State::PENDIENTE_ASESOR;
                    $created = true;
                } else {
                    $process = new Process();
                    $process->producto = strtoupper(\request('producto'));
                    $process->name = \request('name');
                    $process->begin_date = Carbon::now();
                    $process->fk_id_state = State::PENDIENTE;
                }
                $process->state_date = Carbon::now();
                $transactionOk = $transactionOk && $process->save();
                $process->hasState()->attach(State::PENDIENTE);
                if ($transactionOk && !$created) {
                    $processHasUser = new ProcessHasUser();
                    $processHasUser->fk_id_user = $alumno->id;
                    $processHasUser->fk_id_process = $process->id;
                    $processHasUser->fk_id_rol = Rol::ESTUDIANTE;
                    $transactionOk = $transactionOk && $processHasUser->save();
                }
                if ($transactionOk && !$created) {
                    $processHasUser = new ProcessHasUser();
                    $processHasUser->fk_id_user = \request('fk_id_user');
                    $processHasUser->fk_id_process = $process->id;
                    $processHasUser->fk_id_rol = Rol::ASESOR;
                    $transactionOk = $transactionOk && $processHasUser->save();
                }
            }

            if (!$transactionOk) {
                $validator->getMessageBag()->add(
                    'general',
                    'No se pudo crear el documento en este momento'
                );
                return $this->returnCreateErrors($validator);
            }
            return redirect()->route('process_student');
        } catch (\Exception $e) {
            $validator->getMessageBag()->add(
                'general',
                'Ocurrio un error al crear la categoria ' . ' ' . $e->getMessage() . ' ' . $e->getCode() . ' ' . $e->getLine()
            );
            return $this->returnCreateErrors($validator);
        }
    }

    private function storeDocx($file, $alumnoId, $noRevision, $fullName, $title)
    {
        $path = '/docx/student' . $alumnoId;
        $name = $title . $noRevision . '_' . snake_case($fullName) . "_" . Carbon::now()->format('Y-m-d') . "." . $file->extension();

        // Create path if does not exists
        if (!file_exists(public_path() . $path)) {
            mkdir(
                public_path() . $path,
                0777,
                true
            );
        }

        // Move image to corresponding directory
        $file->move(public_path() . $path, $name);
        return $path . '/' . $name;
    }

    public function returnCreateErrors($validator)
    {
        return redirect()
            ->route('student_revision')
            ->withErrors($validator)
            ->withInput();
    }

    public function viewDocument($documentId)
    {
        $document = Document::find($documentId);
        return view('generales.document_view', ["document" => $document]);
    }

    /**
     * TODO POST de revisión
     * @param Request $request
     * @param $documentId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function viewDocumentPost(Request $request, $documentId)
    {
        $transactionOk = true;
        $fileOk = false;
        $docUrl = null;
        $validator = Validator::make($request->all(), [], []);
        $document = Document::find($documentId);

        if ($request->input('fk_id_rol') * 1 === Rol::REVISOR) {
            if (!$document->adviserReview()) {
                $validator->getMessageBag()->add("general", "No se puedes definir tu posición hasta que el
                asesor lo acepte");
                return back()->withErrors($validator)->withInput();
            }
        }
        if ($request->input('fk_id_position') * 1 === Position::RECHAZADO &&
            \request('doc_url', null) === null) {
            $validator->getMessageBag()->add("general",
                "Al rechazar esta versión debes subir un documento con sus respectuvas observacones");
            return back()->withErrors($validator)->withInput();
        }
        $processHasUser = ProcessHasUser::whereFkIdUser(Auth::user()->id)
            ->where('fk_id_process', $document->user->processHasUsers->fk_id_process)
            ->first();
        $process = $processHasUser->process;

        if ($process->hasUser()->where('fk_id_rol', Rol::REVISOR)->count() < 2) {
            $validator->getMessageBag()->add("general",
                "Antes de definir tu postura, se deben asignar los revisores a el proceso");
            return back()->withErrors($validator)->withInput();
        }

        if (request('doc_url') !== null) {
            $fileOk = $request->hasFile('doc_url') &&
                $request->file('doc_url')->isValid();
        }
        if ($fileOk) {
            $docUrl = $this->storeDocx(
                $request->file('doc_url'),
                Auth::user()->id,
                $document->no_document,
                Auth::user()->full_name,
                'revisión_'
            );
        }
        $processHasDocument = new ProcessHasDocument();
        $processHasDocument->document_url = $docUrl;
        $processHasDocument->comments = request('comments');
        $processHasDocument->fk_id_position = request('fk_id_position') * 1;
        $processHasDocument->fk_id_document = $document->id;
        $processHasDocument->fk_id_process_has_user = $processHasUser->id;
        $transactionOk = $processHasDocument->save();
        if ($transactionOk) {
            /**
             *
             */
            if (User::userAdviserProcess($processHasUser->process->id)) {
                if (request('fk_id_position') * 1 === Position::ACEPTADO) {
                    $document->fk_id_status = Status::ACEPTADO_ASESOR;
                    $processHasUser->process->hasState()->attach(State::EN_REVISION);
                    $processHasUser->process->fk_id_state = State::EN_REVISION;
                    $date = Carbon::now();
                    for ($i = 0; $i < 10; $i++) {
                        $date->addDay();
                        $day = $date->dayOfWeek;
                        if ($day === 0 || $day === 6) {
                            $i--;
                        }
                    }
                    $processHasUsers = ProcessHasUser::where('fk_id_rol', Rol::REVISOR)->get();
                    $processHasUsers->each(function ($processHasUser) use ($date) {
                        $processHasUser->delivery_date = $date;
                        $processHasUser->save();
                    });
                }
                if (request('fk_id_position') * 1 === Position::RECHAZADO) {
                    $document->fk_id_status = Status::RECHAZADO_ASESOR;
                    $processHasUser->process->hasState()->attach(State::EN_CORRECCION);
                    $processHasUser->process->fk_id_state = State::EN_CORRECCION;
                }
            }
            $processHasUser->process->checkChangeStatus($document);
            /**
             *
             */
            //            if (request('fk_id_position') * 1 === Position::RECHAZADO && User::userReviewerProcess($processHasUser->process->id)) {
//                $document->fk_id_status = Status::RECHAZADO_REVISOR;
////                $processHasUser->process->hasState()->attach(State::EN_CORRECCION);
////                $processHasUser->process->fk_id_state = State::EN_CORRECCION;
//                $processHasUser->process->checkChangeStatus($document);
//            }
//
//            $countOk = $document->processHasDocuments()->where('fk_id_position', Position::ACEPTADO)->count();
//            if ($countOk >= 3) {
////                $document->fk_id_status = Status::ACEPTADO;
////                $processHasUser->process->hasState()->attach(State::CONCLUIDO);
////                $processHasUser->process->fk_id_state = State::CONCLUIDO;
//                $processHasUser->process->checkChangeStatus($document);
//            }
            $transactionOk = $transactionOk && $document->save();
            $transactionOk = $transactionOk && $processHasUser->process->save();
            if ($transactionOk) {
                return back();
            }
        }
    }
}