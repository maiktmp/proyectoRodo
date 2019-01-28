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

/**
 * App\Http\Model\ProcessHasDocument
 *
 * @property int $id
 * @property string $comments
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $fk_id_document
 * @property int $fk_id_position
 * @property int $fk_id_process_has_user
 * @property-read \App\Http\Model\Document $document
 * @property-read \App\Http\Model\Position $position
 * @property-read \App\Http\Model\ProcessHasUser $processHasUser
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\ProcessHasDocument newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\ProcessHasDocument newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\ProcessHasDocument query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\ProcessHasDocument whereComments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\ProcessHasDocument whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\ProcessHasDocument whereFkIdDocument($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\ProcessHasDocument whereFkIdPosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\ProcessHasDocument whereFkIdProcessHasUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\ProcessHasDocument whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\ProcessHasDocument whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $document_url
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\ProcessHasDocument whereDocumentUrl($value)
 */
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