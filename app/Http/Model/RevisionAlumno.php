<?php
/**
 * Created by PhpStorm.
 * User: presa
 * Date: 27/11/2018
 * Time: 09:08 PM
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Http\Model\RevisionAlumno
 *
 * @property-read \App\Http\Model\Proceso $proceso
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\RevisionAlumno newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\RevisionAlumno newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\RevisionAlumno query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $no_revision
 * @property string $comentarios
 * @property string $documento_url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\RevisionAlumno whereComentarios($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\RevisionAlumno whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\RevisionAlumno whereDocumentoUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\RevisionAlumno whereFechaEntrega($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\RevisionAlumno whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\RevisionAlumno whereNoRevision($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\RevisionAlumno whereUpdatedAt($value)
 */
class RevisionAlumno extends Model
{

    protected $table = 'revision_alumno';

    public function proceso()
    {
        return $this->belongsTo(
            Proceso::class,
            'fk_id_proceso',
            'id'
        );
    }
}