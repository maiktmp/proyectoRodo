<?php
/**
 * Created by PhpStorm.
 * User: presa
 * Date: 27/11/2018
 * Time: 09:00 PM
 */

namespace App\Http\Controllers;


use App\Http\Model\RevisionAlumno;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

class AlumnoController extends Controller
{
    public function revision()
    {
        $alumno = Auth::guard('alumno')->user();
        return view('alumno.revision', [
            'alumno' => $alumno
        ]);
    }

    public function revisionPost(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'documento_url' => 'required|mimes:doc,docx',
                'comentarios' => 'max:1000,',

            ],
            [
                'documento_url.required' => 'Ingresa el docuento de word.',
                'documento_url.mimetypes' => 'Ingresa un archivo de word.',
                'comentarios.max' => 'Ingresa un comentario más pequeño',
            ]
        )->validate();
        try {
            $alumno = Auth::guard('alumno')->user();
            $revisionAlumno = new RevisionAlumno();
            $revisionAlumno->no_revision = RevisionAlumno::all()->count() + 1;
            $revisionAlumno->comentarios = $request->get('comentarios', "");
            $revisionAlumno->documento_url = "temporal";
            $transactionOk = $revisionAlumno->save();
            if ($transactionOk) {
                $fileOk = $request->hasFile('documento_url') &&
                    $request->file('documento_url')->isValid();
            }
            if ($fileOk) {
                $docUrl = $this->storeDocx(
                    $request->file('documento_url'),
                    $alumno->id,
                    $revisionAlumno->no_revision
                );
                $revisionAlumno->documento_url = $docUrl;
                $transactionOk = $transactionOk && $revisionAlumno->save();
            }
            if (!$transactionOk) {
                $validator->getMessageBag()->add(
                    'general',
                    'No se pudo crear el documento en este momento'
                );
                return $this->returnCreateErrors($validator);
            }
            return dd("p<s");
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
        $path = '/docx/students' . $alumnoId;
        $name = 'version_' . $noRevision . '_' . Carbon::now()->format('Y/m/d') . $file->extension();

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