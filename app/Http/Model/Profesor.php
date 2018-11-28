<?php
/**
 * Created by PhpStorm.
 * User: presa
 * Date: 27/11/2018
 * Time: 09:18 PM
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    protected $table = 'profesor';

    public function revisionesAsesor()
    {
        return $this->hasMany(
            RevisionAsesor::class,
            'fk_id_profesor',
            'id'
        );
    }

    public function involucrados()
    {
        return $this->hasMany(
            Involucrado::class,
            'fk_id_profesor',
            'id'
        );
    }

    public function revisionesRevisor()
    {
        return $this->hasMany(
            RevisionRevisor::class,
            'fk_id_profesor',
            'id'
        );
    }

    public function historialProfesor()
    {
        return $this->hasOne(
            HistorialProfesor::class,
            'fk_id_profesor',
            'id'
        );
    }

}