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
 * App\Http\Model\UserType
 *
 * @property int $id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\UserType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\UserType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\UserType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\UserType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\UserType whereName($value)
 * @mixin \Eloquent
 */
class UserType extends Model
{
    protected $table = "user_type";
    public $timestamps = false;
}