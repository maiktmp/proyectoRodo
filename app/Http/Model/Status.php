<?php
/**
 * Created by PhpStorm.
 * User: presa
 * Date: 22/01/2019
 * Time: 10:09 PM
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;


/**
 * App\Http\Model\Status
 *
 * @property int $id
 * @property string $nombre
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Status newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Status newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Status query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Status whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Status whereNombre($value)
 * @mixin \Eloquent
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Status whereName($value)
 */
class Status extends Model
{
    const PENDIENTE = 1;
    const ACEPTADO_ASESOR = 2;
    const RECHAZADO_ASESOR = 3;
    const RECHAZADO_REVISOR = 4;
    const ACEPTADO = 5;
    protected $table = "status";
    public $timestamps = false;
}