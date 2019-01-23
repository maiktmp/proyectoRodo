<?php
/**
 * Created by PhpStorm.
 * User: presa
 * Date: 22/01/2019
 * Time: 10:09 PM
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $table = "document";
    public $timestamps = false;

    public function processHasDocuments()
    {
        return $this->hasMany(
            ProcessHasDocument::class,
            'fk_id_document',
            'id'
        );
    }
}