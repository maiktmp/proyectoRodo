<?php
/**
 * Created by PhpStorm.
 * User: presa
 * Date: 27/11/2018
 * Time: 09:11 PM
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

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