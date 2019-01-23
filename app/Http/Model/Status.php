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
    protected $table = "status";
    public $timestamps = false;
}