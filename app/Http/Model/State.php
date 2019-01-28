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
 * App\Http\Model\State
 *
 * @property int $id
 * @property string $nombre
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\State newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\State newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\State query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\State whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\State whereNombre($value)
 * @mixin \Eloquent
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\State whereName($value)
 */
class State extends Model
{
    const PENDIENTE = 1;
    const PENDIENTE_ASESOR = 2;
    const EN_REVISION = 3;
    const EN_CORRECCION = 4;
    const CONCLUIDO = 5;
    const RETRASADO = 6;

    protected $table = "state";
    public $timestamps = false;
}