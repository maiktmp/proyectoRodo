<?php
/**
 * Created by PhpStorm.
 * User: presa
 * Date: 27/11/2018
 * Time: 09:15 PM
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class Involucrado extends Model
{

    protected $table = 'involucrado';

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