<?php
/**
 * Created by PhpStorm.
 * User: presa
 * Date: 27/11/2018
 * Time: 09:02 PM
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Http\Model\Proceso
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Http\Model\Acciones[] $acciones
 * @property-read \App\Http\Model\Alumno $alumno
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Http\Model\Involucrado[] $involucrados
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Http\Model\RevisionRevisor[] $revisionRevisor
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Http\Model\RevisionAlumno[] $revisionesAlumno
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Http\Model\RevisionAsesor[] $revisionesAsesor
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Proceso newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Proceso newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Proceso query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $opcion_tit
 * @property string $estado
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $fk_id_alumno
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Proceso whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Proceso whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Proceso whereFkIdAlumno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Proceso whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Proceso whereOpcionTit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Proceso whereUpdatedAt($value)
 */
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

    public function revisionesAsesor()
    {
        return $this->hasMany(
            RevisionAsesor::class,
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
