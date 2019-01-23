<?php
/**
 * Created by PhpStorm.
 * User: presa
 * Date: 22/01/2019
 * Time: 10:13 PM
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    protected $table = "process";

    public function hasState()
    {
        return $this->belongsToMany(
            State::class,
            'process_has_state',
            'fk_id_process',
            'fk_id_state'
        );
    }

    public function hasAction()
    {
        return $this->belongsToMany(
            Action::class,
            'process_has_action',
            'fk_id_process',
            'fk_id_action'
        );
    }

    public function hasUser()
    {
        return $this->hasMany(
            ProcessHasUser::class,
            'fk_id_process',
            'id'
        );
    }

}