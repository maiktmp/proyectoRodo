<?php
/**
 * Created by PhpStorm.
 * User: presa
 * Date: 27/11/2018
 * Time: 09:08 PM
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class RevisionAlumno extends Model
{

    protected $table = 'revision_alumno';

    public function proceso()
    {
        return $this->belongsTo(
            Proceso::class,
            'fk_id_proceso',
            'id'
        );
    }
}