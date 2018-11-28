<?php
/**
 * Created by PhpStorm.
 * User: presa
 * Date: 27/11/2018
 * Time: 09:01 PM
 */

namespace App\Http\Model;


use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


/**
 * App\Http\Model\Alumno
 *
 * @property-read \App\Http\Model\Proceso $proceso
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Alumno newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Alumno newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Alumno query()
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Alumno whereApellidoM($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Alumno whereApellidoP($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Alumno whereCorreo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Alumno whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Alumno whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Alumno whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Alumno wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Alumno whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Alumno whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Alumno whereUsuario($value)
 */
class Alumno  extends Authenticatable
{
    use Notifiable;

    protected $table = "alumno";

    protected $hidden = ['password',  'remember_token'];

    public function proceso()
    {
        return $this->hasOne(
            Proceso::class,
            'fk_id_alumno',
            'id'
        );
    }
}