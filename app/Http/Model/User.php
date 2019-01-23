<?php
/**
 * Created by PhpStorm.
 * User: presa
 * Date: 22/01/2019
 * Time: 09:59 PM
 */

namespace App\Http\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;


use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    protected $table = "user";

    public function userType()
    {
        return $this->belongsTo(
            UserType::class,
            'fk_id_user_type',
            'id'
        );
    }

    public function processHasUsers()
    {
        return $this->hasMany(
            ProcessHasUser::class,
            'fk_id_user',
            'id'
        );
    }
}