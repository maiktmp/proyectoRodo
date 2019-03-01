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

    public function parameters($processId)
    {
        return view("admin.parameters", ["processId" => $processId]);
    }

    public function postParameters(Request $request, $processId)
    {
        $rules = [
            "name" => "required",
            "product" => "required"
        ];
        $messages = [
            "name.required" => "El nombre del proyecto es requerido",
            "product.required" => "El producto es requerido"
        ];
        \Validator::make(
            $request->all(),
            $rules,
            $messages
        )->validate();
        $process = Process::find($processId);
        $process->producto = $request->get('product');
        $process->name = $request->get('name');
        try {
            $process->saveOrFail();
            return redirect()->route('get_process',['processId'=>$processId]);
        } catch (\Throwable $e) {
            return back()->withInput()->withErrors([
                "general" => "No se pudo asiganr los valores " . " " . $e->getMessage()
            ]);
        }
    }
}