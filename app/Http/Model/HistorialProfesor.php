<?php
/**
 * Created by PhpStorm.
 * User: presa
 * Date: 27/11/2018
 * Time: 09:21 PM
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

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