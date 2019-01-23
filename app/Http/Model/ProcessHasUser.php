<?php
/**
 * Created by PhpStorm.
 * User: presa
 * Date: 22/01/2019
 * Time: 10:19 PM
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class ProcessHasUser extends Model
{
    protected $table = "process_has_user";

    public function user()
    {
        return $this->belongsTo(
            User::class,
            'fk_id_user',
            'id'
        );
    }

    public function process()
    {
        return $this->belongsTo(
            Process::class,
            'fk_id_process',
            'id'
        );
    }

    public function rol()
    {
        return $this->belongsTo(
            Rol::class,
            'fk_id_rol',
            'id'
        );
    }

    public function hasDocuments()
    {
        return $this->hasMany(
            ProcessHasDocument::class,
            'fk_id_process_has_user',
            'id'
        );
    }

}