<?php
/**
 * Created by PhpStorm.
 * User: presa
 * Date: 28/11/2018
 * Time: 01:10 AM
 */

namespace App\Http\Controllers;


use App\Http\Model\Involucrado;
use App\Http\Model\Proceso;
use App\Http\Model\Process;
use App\Http\Model\ProcessHasUser;
use App\Http\Model\Profesor;
use App\Http\Model\RevisionAsesor;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function index()
    {
        return view('admin.panel');
    }

    public function getProcess($processId)
    {
        $process = Proceso::find($processId);
        return view('generales.proceso', [
            'process' => $process
        ]);
    }

    public function updateProcess($processId)
    {
        $process = Proceso::find($processId);
        return view('generales.proceso', [
            'process' => $process,
            'update' => true
        ]);
    }

    public function updateProcessPost(Request $request, $processId)
    {
        if ($request->input('fk_id_profesor', null) !== null) {
            $asesor = new Involucrado();
            $asesor->fk_id_proceso = $processId;
            $asesor->fk_id_profesor = $request->input('fk_id_profesor', 0);
            $asesor->rol = 'asesor';
            $asesor->enterado = false;
            $asesor->save();
        }

        if ($request->input('fk_id_profesor1', null) !== null) {
            $asesor = new Involucrado();
            $asesor->fk_id_proceso = $processId;
            $asesor->fk_id_profesor = $request->input('fk_id_profesor1', 0);
            $asesor->rol = 'Co asesor';
            $asesor->enterado = false;
            $asesor->save();
        }

        if ($request->input('fk_id_profesor3', null) !== null
            && $request->input('fecha', null) !== null
        ) {
            $asesor = new Involucrado();
            $asesor->fk_id_proceso = $processId;
            $asesor->fk_id_profesor = $request->input('fk_id_profesor3', 0);
            $asesor->rol = 'Revisor';
            $asesor->enterado = false;
            $asesor->save();
        }

        if ($request->input('fk_id_profesor4', null) !== null
            && $request->input('fecha1', null) !== null
        ) {
            $asesor = new Involucrado();
            $asesor->fk_id_proceso = $processId;
            $asesor->fk_id_profesor = $request->input('fk_id_profesor4', 0);
            $asesor->rol = 'Revisor';
            $asesor->enterado = false;
            $asesor->save();
        }
        return redirect()->route('get_process', ['proccessId' => $processId]);
    }

    public function getTeachers()
    {
        return Profesor::all();
    }

    public function getStatusTeachers($processId)
    {
        if ($processId == 0) {
            $users = ProcessHasUser::where('active', false)
                ->get();
        } else {
            $users = ProcessHasUser::whereFkIdProcess($processId)
                ->where('active', false)
                ->get();
        }

        return view('admin.user_disabled', [
            "users" => $users,
            "processId" => $processId
        ]);
    }
}