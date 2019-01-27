<?php
/**
 * Created by PhpStorm.
 * User: presa
 * Date: 24/01/2019
 * Time: 10:46 PM
 */

namespace App\Http\Controllers;


use App\Http\Model\Process;
use App\Http\Model\ProcessHasUser;
use App\Http\Model\Rol;
use App\Http\Model\User;
use Illuminate\Http\Request;
use Validator;

class ProcessController extends Controller
{

    public function indexContents()
    {
        $process = Process::orderBy('created_at', 'ASC')
            ->whereActive(true)
            ->get();

        return view('generales.process_index', ['process' => $process]);
    }

    public function view($processId)
    {
        $process = Process::find($processId);
        return view('generales.documents_index', ['process' => $process]);
    }

    public function updateProcess($processId)
    {
        $process = Process::find($processId);
        return view('admin.update_process', ['process' => $process]);
    }

    public function updateProcessPost(Request $request, $processId)
    {
        $rules = [
            'fk_id_user' => 'required',
        ];
        if ($request->input('fk_id_rol') * 1 === Rol::REVISOR) {
            $rules['delivery_date'] = 'required|date|after:now';

        } else {
            $rules['delivery_date'] = 'nullable|date|after:now';
        }
        $validator = Validator::make(
            $request->all(),
            $rules,
            [
                'fk_id_user.required' => 'Ingrese un docente.',
                'delivery_date.after' => 'Ingrese una fecha posteriór a este momento.',
                'delivery_date.required' => 'Ingrese una fecha de entrega.',
            ]
        );
        $validator->validate();
        $validator = Validator::make([], []);
        $processHasUserId = $request->input('update-row', null);
        $process = Process::find($processId);

        $processHasUser = $process->hasUser()->whereFkIdUser($request->input('fk_id_user'))->first();

        if ($processHasUser != null && $processHasUserId === null) {
            $validator->getMessageBag()->add('general',
                "Actualmente el docente "
                . $processHasUser->user->fullname
                . "ya se encuentra asignado a este proceso como "
                . $processHasUser->rol->name
            );
            return back()->withInput()->withErrors($validator);
        }
        if ($processHasUserId !== null) {
            $processHasUser = ProcessHasUser::find($processHasUserId);
        } else {
            $processHasUser = new ProcessHasUser();
        }
        $processHasUser->fill($request->all());
        if ($processHasUser->fk_id_rol == Rol::ASESOR) {
            $processHasUser->delivery_date = null;
        }
        $processHasUser->fk_id_process = $process->id;
        if ($processHasUser->save()) {
            return back();
        } else {
            return error;
        }
    }

    public function changeStatus($processHasUserId, $state)
    {
        $processHaUser = ProcessHasUser::find($processHasUserId);
        $processHaUser->active = $state === "1" ? true : false;
        if ($processHaUser->save()) {
            return redirect()->route('update_process', ['processId' => $processHaUser->process->id]);
        } else {
            return error;
        }
    }

    public function getTeachers()
    {
        return response()->json(User::usersTeachers());
    }
}