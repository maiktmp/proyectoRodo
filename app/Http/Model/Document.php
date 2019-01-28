<?php
/**
 * Created by PhpStorm.
 * User: presa
 * Date: 22/01/2019
 * Time: 10:09 PM
 */

namespace App\Http\Model;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Http\Model\Document
 *
 * @property int $id
 * @property int $no_document
 * @property string|null $url
 * @property int $approved
 * @property int $fk_id_status
 * @property int $fk_id_user
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Http\Model\ProcessHasDocument[] $processHasDocuments
 * @property-read \App\Http\Model\Status $status
 * @property-read \App\Http\Model\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Document newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Document newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Document query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Document whereApproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Document whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Document whereFkIdStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Document whereFkIdUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Document whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Document whereNoDocument($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Document whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Document whereUrl($value)
 * @mixin \Eloquent
 * @property string|null $comments
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Document whereComments($value)
 */
class Document extends Model
{
    protected $table = "document";
    protected $dates = ['created_at'];

    public function processHasDocuments()
    {
        return $this->hasMany(
            ProcessHasDocument::class,
            'fk_id_document',
            'id'
        );
    }

    public function status()
    {
        return $this->belongsTo(
            Status::class,
            'fk_id_status',
            'id'
        );
    }
    public function user()
    {
        return $this->belongsTo(
            User::class,
            'fk_id_user',
            'id'
        );
    }

}