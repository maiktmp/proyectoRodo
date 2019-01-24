<?php
/**
 * Created by PhpStorm.
 * User: presa
 * Date: 27/11/2018
 * Time: 09:00 PM
 */

namespace App\Http\Controllers;


use App\Http\Model\Document;
use App\Http\Model\Process;
use App\Http\Model\ProcessHasUser;
use App\Http\Model\RevisionAlumno;
use App\Http\Model\Rol;
use App\Http\Model\State;
use App\Http\Model\Status;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
        $validator = Validator::make(
            $request->all(),
            [
                'url' => 'required|mimes:doc,docx',
                'comments' => 'max:1000,',

            ],
            [
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
                    $alumno->id,
                    $no_document
                );
                $document->url = $docUrl;
                $transactionOk = $transactionOk && $document->save();
            }
            if ($transactionOk) {
                $process = new Process();
                $process->begin_date = Carbon::now();
                $process->state_date = Carbon::now();
                $transactionOk = $transactionOk && $process->save();
                $process->hasState()->attach(State::PENDIENTE);
                if ($transactionOk) {
                    $processHasUser = new ProcessHasUser();
                    $processHasUser->fk_id_user = $alumno->id;
                    $processHasUser->fk_id_process = $process->id;
                    $processHasUser->fk_id_rol = Rol::ESTUDIANTE;
                    $transactionOk = $transactionOk && $processHasUser->save();
                }
                if ($transactionOk) {
                    $processHasUser = new ProcessHasUser();
                    $processHasUser->fk_id_user = $alumno->id;
                    $processHasUser->fk_id_process = $process->id;
                    $processHasUser->fk_id_rol = Rol::ESTUDIANTE;
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

    private function storeDocx($file, $alumnoId, $noRevision)
    {
        $path = '/docx/student' . $alumnoId;
        $name = 'version_' . $noRevision . '_' . Carbon::now()->format('Y/m/d') . "." . $file->extension();

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
}