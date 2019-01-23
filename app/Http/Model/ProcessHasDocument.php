<?php
/**
 * Created by PhpStorm.
 * User: presa
 * Date: 22/01/2019
 * Time: 10:22 PM
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;
use PhpParser\Comment\Doc;

class ProcessHasDocument extends Model
{

    protected $table = "process_has_document";

    public function position()
    {
        return $this->belongsTo(
            Position::class,
            'fk_id_position',
            'id'
        );
    }

    public function processHasUser()
    {
        return $this->belongsTo(
            ProcessHasUser::class,
            'fk_id_process_has_user',
            'id'
        );
    }

    public function document()
    {
        return $this->belongsTo(
            Document::class,
            'fk_id_document',
            'id'
        );
    }
}