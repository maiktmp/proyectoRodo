<?php
/**
 * Created by PhpStorm.
 * User: presa
 * Date: 22/01/2019
 * Time: 10:13 PM
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Http\Model\Process
 *
 * @property int $id
 * @property string $begin_date
 * @property string $state_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Http\Model\Action[] $hasAction
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Http\Model\State[] $hasState
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Http\Model\ProcessHasUser[] $hasUser
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Process newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Process newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Process query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Process whereBeginDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Process whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Process whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Process whereStateDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Process whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Process extends Model
{
    protected $table = "process";

    public function hasState()
    {
        return $this->belongsToMany(
            State::class,
            'process_has_state',
            'fk_id_process',
            'fk_id_state'
        );
    }

    public function hasAction()
    {
        return $this->belongsToMany(
            Action::class,
            'process_has_action',
            'fk_id_process',
            'fk_id_action'
        );
    }

    public function hasUser()
    {
        return $this->hasMany(
            ProcessHasUser::class,
            'fk_id_process',
            'id'
        );
    }

}