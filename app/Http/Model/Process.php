<?php
/**
 * Created by PhpStorm.
 * User: presa
 * Date: 22/01/2019
 * Time: 10:13 PM
 */

namespace App\Http\Model;


use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Http\Model\Process
 *
 * @property int $id
 * @property Carbon $begin_date
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
 * @property int $active
 * @property int $fk_id_state
 * @property-read \App\Http\Model\State $state
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Process whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Process whereFkIdState($value)
 */
class Process extends Model
{
    protected $table = "process";
    protected $dates = ['begin_date'];

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

    public function state()
    {
        return $this->belongsTo(
            State::class,
            'fk_id_state',
            'id'
        );
    }

    public static function firstFilter()
    {
        return Process::whereFkIdState(State::PENDIENTE)->get();
    }

    public static function secondFilter()
    {
        return Process::whereFkIdState(State::PENDIENTE_ASESOR)->get();
    }

    public static function thirdFilter()
    {
        return Process::whereFkIdState(State::EN_REVISION)->get();
    }

    public static function fourthFilter()
    {
        return Process::whereFkIdState(State::EN_CORRECCION)->get();
    }

    public static function fifthFilter()
    {
        return Process::whereFkIdState(State::RETRASADO)->get();
    }

    public static function sixtFilter()
    {
        return Process::whereFkIdState(State::CONCLUIDO)->get();
    }

    public static function reviewerNotView()
    {
        return Process::whereHas('hasUser', function ($q) {
            $q->where('fk_id_user', Auth::user()->id)
                ->where('fk_id_rol', Rol::REVISOR);
        })->where('fk_id_state', State::EN_REVISION)->get();
    }

    public static function reviewerAccept()
    {
        return Process::whereHas('hasUser', function ($q) {
            $q->where('fk_id_user', Auth::user()->id)
                ->where('fk_id_rol', Rol::REVISOR);
        })->where('fk_id_state', State::EN_CORRECCION)->get();
    }

    public static function teacherProcessComplete()
    {
        return Process::whereHas('hasUser', function ($q) {
            $q->where('fk_id_user', Auth::user()->id);
        })->where('fk_id_state', State::CONCLUIDO)->get();
    }


    public static function adviserNotView()
    {
        return Process::whereHas('hasUser', function ($q) {
            $q->where('fk_id_user', Auth::user()->id)
                ->where('fk_id_rol', Rol::ASESOR);
        })->where('fk_id_state', State::PENDIENTE_ASESOR)->get();
    }

    public static function adviserAccept()
    {
        return Process::whereHas('hasUser', function ($q) {
            $q->where('fk_id_user', Auth::user()->id)
                ->where('fk_id_rol', Rol::ASESOR);
        })->whereIn('fk_id_state', [State::EN_REVISION, State::EN_CORRECCION])->get();
    }

    public function revised($userId, $processId)
    {
        ProcessHasUser::whereFkIdUser($userId)
            ->where('fk_id_process', $processId)
            ->whereHas('revision.', function ($q) {
                $q->where('id',Status::Recha);
            });
    }
}