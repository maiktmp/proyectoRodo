<?php
/**
 * Created by PhpStorm.
 * User: presa
 * Date: 27/11/2018
 * Time: 09:18 PM
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Http\Model\Profesor
 *
 * @property-read \App\Http\Model\HistorialProfesor $historialProfesor
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Http\Model\Involucrado[] $involucrados
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Http\Model\RevisionAsesor[] $revisionesAsesor
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Http\Model\RevisionRevisor[] $revisionesRevisor
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Profesor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Profesor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Profesor query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $nombre
 * @property string $apellidoP
 * @property string $apellidoM
 * @property string $correo
 * @property string $usuario
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Profesor whereApellidoM($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Profesor whereApellidoP($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Profesor whereCorreo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Profesor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Profesor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Profesor whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Profesor wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Profesor whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Profesor whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Profesor whereUsuario($value)
 */
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