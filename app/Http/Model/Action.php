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
 * App\Http\Model\Action
 *
 * @property int $id
 * @property string $nombre
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Action newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Action newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Action query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Action whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Action whereNombre($value)
 * @mixin \Eloquent
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Action whereName($value)
 */
class Action extends Model
{
    protected $table = "action";
    public $timestamps = false;
}