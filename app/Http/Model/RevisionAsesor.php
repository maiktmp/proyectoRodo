<?php
/**
 * Created by PhpStorm.
 * User: presa
 * Date: 27/11/2018
 * Time: 09:11 PM
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Http\Model\RevisionAsesor
 *
 * @property-read \App\Http\Model\Proceso $proceso
 * @property-read \App\Http\Model\Profesor $profesor
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\RevisionAsesor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\RevisionAsesor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\RevisionAsesor query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $no_revision
 * @property string $comentarios
 * @property int $postura
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $fk_id_proceso
 * @property int $fk_id_profesor
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\RevisionAsesor whereComentarios($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\RevisionAsesor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\RevisionAsesor whereFkIdProceso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\RevisionAsesor whereFkIdProfesor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\RevisionAsesor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\RevisionAsesor whereNoRevision($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\RevisionAsesor wherePostura($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\RevisionAsesor whereUpdatedAt($value)
 */
class RevisionAsesor extends Model
{

    protected $table = 'revision_asesor';

    public function proceso()
    {
        return $this->belongsTo(
            Proceso::class,
            'fk_id_proceso',
            'id'
        );
    }

    public function profesor()
    {
        return $this->belongsTo(
            Profesor::class,
            'fk_id_profesor',
            'id'
        );
    }

}