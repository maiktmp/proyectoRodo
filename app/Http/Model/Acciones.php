<?php
/**
 * Created by PhpStorm.
 * User: presa
 * Date: 27/11/2018
 * Time: 09:10 PM
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Http\Model\Acciones
 *
 * @property-read \App\Http\Model\Proceso $proceso
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Acciones newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Acciones newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Acciones query()
 * @mixin \Eloquent
 */
class Acciones extends Model
{
    protected $table = 'acciones';

    public function proceso()
    {
        return $this->belongsTo(
            Proceso::class,
            'fk_id_proceso',
            'id'
        );
    }
}