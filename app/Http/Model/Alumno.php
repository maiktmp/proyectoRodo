<?php
/**
 * Created by PhpStorm.
 * User: presa
 * Date: 27/11/2018
 * Time: 09:01 PM
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    private $table = "alumno";

    public function proceso()
    {
        return $this->hasOne(
            Proceso::class,
            'fk_id_alumno',
            'id'
        );
    }
}