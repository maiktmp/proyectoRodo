<?php
/**
 * Created by PhpStorm.
 * User: presa
 * Date: 27/11/2018
 * Time: 09:15 PM
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Http\Model\Involucrado
 *
 * @property-read \App\Http\Model\Proceso $proceso
 * @property-read \App\Http\Model\Profesor $profesor
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Involucrado newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Involucrado newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Involucrado query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $rol
 * @property string $enterado
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $fk_id_proceso
 * @property int $fk_id_profesor
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Involucrado whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Involucrado whereEnterado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Involucrado whereFkIdProceso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Involucrado whereFkIdProfesor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Involucrado whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Involucrado whereRol($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Involucrado whereUpdatedAt($value)
 */
class Involucrado extends Model
{

    protected $table = 'involucrado';

    public function proceso()
    {
        return $this->belongsTo(
            Proceso::class,
            'fk_id_proceso',
            'id'
        );
    }

    public function profesor()
    {
        return $this->belongsTo(
            Profesor::class,
            'fk_id_profesor',
            'id'
        );
    }

}