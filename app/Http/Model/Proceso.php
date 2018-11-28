<?php
/**
 * Created by PhpStorm.
 * User: presa
 * Date: 27/11/2018
 * Time: 09:02 PM
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class Proceso extends Model
{
    protected $table = 'proceso';

    public function alumno()
    {
        return $this->belongsTo(
            Alumno::class,
            'fk_id_alumno',
            'id'
        );
    }

    public function revisionesAlumno()
    {
        return $this->hasMany(
            RevisionAlumno::class,
            'fk_id_proceso',
            'id'
        );
    }

    public function acciones()
    {
        return $this->hasMany(
            Acciones::class,
            'fk_id_proceso',
            'id'
        );
    }

    public function revisionesProfesor()
    {
        return $this->hasMany(
            RevisionProfesor::class,
            'fk_id_proceso',
            'id'
        );
    }

    public function involucrados()
    {
        return $this->hasMany(
            Involucrado::class,
            'fk_id_proceso',
            'id'
        );
    }

    public function revisionRevisor()
    {
        return $this->hasMany(
            RevisionRevisor::class,
            'fk_id_proceso',
            'id'
        );
    }


}
