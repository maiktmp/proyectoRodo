<?php
/**
 * Created by PhpStorm.
 * User: presa
 * Date: 27/11/2018
 * Time: 09:10 PM
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Http\Model\Acciones
 *
 * @property-read \App\Http\Model\Proceso $proceso
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Acciones newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Acciones newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Acciones query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $accion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $fk_id_involucrado
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Acciones whereAccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Acciones whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Acciones whereFkIdInvolucrado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Acciones whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Acciones whereUpdatedAt($value)
 */
class Acciones extends Model
{
    protected $table = 'acciones';

    public function proceso()
    {
        return $this->belongsTo(
            Proceso::class,
            'fk_id_proceso',
            'id'
        );
    }
}