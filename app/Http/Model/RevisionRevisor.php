<?php
/**
 * Created by PhpStorm.
 * User: presa
 * Date: 27/11/2018
 * Time: 09:16 PM
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Http\Model\RevisionRevisor
 *
 * @property-read \App\Http\Model\Proceso $proceso
 * @property-read \App\Http\Model\Profesor $profesor
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\RevisionRevisor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\RevisionRevisor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\RevisionRevisor query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $no_revision
 * @property string $fecha_limite
 * @property string $fecha_entrega
 * @property string $comentarios
 * @property int $postura
 * @property string $documento_url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $fk_id_proceso
 * @property int $fk_id_profesor
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\RevisionRevisor whereComentarios($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\RevisionRevisor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\RevisionRevisor whereDocumentoUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\RevisionRevisor whereFechaEntrega($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\RevisionRevisor whereFechaLimite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\RevisionRevisor whereFkIdProceso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\RevisionRevisor whereFkIdProfesor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\RevisionRevisor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\RevisionRevisor whereNoRevision($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\RevisionRevisor wherePostura($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\RevisionRevisor whereUpdatedAt($value)
 */
class RevisionRevisor extends Model
{

    protected $table = 'revision_revisor';

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