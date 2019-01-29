<?php
/**
 * Created by PhpStorm.
 * User: presa
 * Date: 22/01/2019
 * Time: 09:59 PM
 */

namespace App\Http\Model;

use Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Http\Model\User
 *
 * @property int $id
 * @property string $name
 * @property string $last_name
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $fk_id_user_type
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Http\Model\ProcessHasUser $processHasUsers
 * @property-read \App\Http\Model\UserType $userType
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\User whereFkIdUserType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\User whereUsername($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Http\Model\Document[] $documents
 * @property-read mixed $full_name
 */
class User extends Authenticatable
{
    protected $table = "user";

    protected $appends = [
        'full_name'
    ];

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
        return $this->hasOne(
            ProcessHasUser::class,
            'fk_id_user',
            'id'
        );
    }

    public function documents()
    {
        return $this->hasMany(
            Document::class,
            'fk_id_user',
            'id'
        );
    }

    public function getFullNameAttribute()
    {
        return $this->name . ' ' . $this->last_name;
    }

    public static function isAdmin()
    {
        return \Auth::user()->fk_id_user_type === UserType::ADMIN;
    }

    public static function isStudent()
    {
        return \Auth::user()->fk_id_user_type === UserType::ALUMNO;
    }

    public static function isTeacher()
    {
        return \Auth::user()->fk_id_user_type === UserType::PROFESOR;
    }

    public static function usersTeachers()
    {
        return User::whereFkIdUserType(UserType::PROFESOR)->get();
    }

    public static function userReviewerProcess($processId)
    {
        $process = Process::whereId($processId)
            ->whereHas('hasUser', function ($q) {
                $q->where('fk_id_user', Auth::user()->id)
                    ->where('fk_id_rol', Rol::REVISOR);
            })->first();
        return $process !== null;
    }

    public static function userAdviserProcess($processId)
    {
        $process = Process::whereId($processId)
            ->whereHas('hasUser', function ($q) {
                $q->where('fk_id_user', Auth::user()->id)
                    ->where('fk_id_rol', Rol::ASESOR);
            })->first();
        return $process !== null;
    }


}