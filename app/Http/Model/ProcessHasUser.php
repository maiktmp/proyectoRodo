<?php
/**
 * Created by PhpStorm.
 * User: presa
 * Date: 22/01/2019
 * Time: 10:19 PM
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Http\Model\ProcessHasUser
 *
 * @property int $id
 * @property string $delivery_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $fk_id_user
 * @property int $fk_id_process
 * @property int $fk_id_rol
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Http\Model\ProcessHasDocument[] $hasDocuments
 * @property-read \App\Http\Model\Process $process
 * @property-read \App\Http\Model\Rol $rol
 * @property-read \App\Http\Model\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\ProcessHasUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\ProcessHasUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\ProcessHasUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\ProcessHasUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\ProcessHasUser whereDeliveryDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\ProcessHasUser whereFkIdProcess($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\ProcessHasUser whereFkIdRol($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\ProcessHasUser whereFkIdUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\ProcessHasUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\ProcessHasUser whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProcessHasUser extends Model
{
    protected $table = "process_has_user";

    public function user()
    {
        return $this->belongsTo(
            User::class,
            'fk_id_user',
            'id'
        );
    }

    public function process()
    {
        return $this->belongsTo(
            Process::class,
            'fk_id_process',
            'id'
        );
    }

    public function rol()
    {
        return $this->belongsTo(
            Rol::class,
            'fk_id_rol',
            'id'
        );
    }

    public function hasDocuments()
    {
        return $this->hasMany(
            ProcessHasDocument::class,
            'fk_id_process_has_user',
            'id'
        );
    }

}