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
 * App\Http\Model\Rol
 *
 * @property int $id
 * @property string $nombre
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Rol newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Rol newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Rol query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Rol whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Rol whereNombre($value)
 * @mixin \Eloquent
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Rol whereName($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Http\Model\ProcessHasUser[] $process
 */
class Rol extends Model
{
    const ESTUDIANTE = 1;
    const ASESOR = 2;
    const REVISOR = 3;
    protected $table = "rol";
    public $timestamps = false;

    public static function asMap()
    {
        return self::orderBy('id', 'DESC')->where('id', '<>', self::ESTUDIANTE)->pluck('name', 'id');
    }

    public static function asMapInProcess($processId, $userId)
    {
        return self::whereHas('process', function ($q) use ($userId, $processId) {
            $q->where('fk_id_user', $userId)
                ->where('fk_id_process', $processId);
        })
            ->get()
            ->pluck('name', 'id');
    }

    public function process()
    {
        return $this->hasMany(
            ProcessHasUser::class,
            'fk_id_rol',
            'id'
        );
    }
}