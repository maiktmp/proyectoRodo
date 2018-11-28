<?php
/**
 * Created by PhpStorm.
 * User: presa
 * Date: 27/11/2018
 * Time: 09:21 PM
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Http\Model\HistorialProfesor
 *
 * @property-read \App\Http\Model\Profesor $profesor
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\HistorialProfesor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\HistorialProfesor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\HistorialProfesor query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $no_revisor
 * @property int $no_asesor
 * @property int $sancion
 * @property string $ultima_revision
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\HistorialProfesor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\HistorialProfesor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\HistorialProfesor whereNoAsesor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\HistorialProfesor whereNoRevisor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\HistorialProfesor whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\HistorialProfesor whereSancion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\HistorialProfesor whereUltimaRevision($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\HistorialProfesor whereUpdatedAt($value)
 */
class HistorialProfesor extends Model
{

    protected $table = 'historial_profesor';

    public function profesor()
    {
        return $this->belongsTo(
            Profesor::class,
            'fk_id_profesor',
            'id'
        );
    }
}