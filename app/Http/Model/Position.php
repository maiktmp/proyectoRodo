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
 * App\Http\Model\Position
 *
 * @property int $id
 * @property string $nombre
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Position newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Position newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Position query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Position whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Position whereNombre($value)
 * @mixin \Eloquent
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Position whereName($value)
 */
class Position extends Model
{
    protected $table = "position";
    public $timestamps = false;
}