<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\Admin
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin query()
 * @mixin \Eloquent
 */
	class Admin extends \Eloquent {}
}

namespace App\Http\Model{
/**
 * App\Http\Model\Action
 *
 * @property int $id
 * @property string $nombre
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Action newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Action newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Action query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Action whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Action whereNombre($value)
 * @mixin \Eloquent
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Action whereName($value)
 */
	class Action extends \Eloquent {}
}

namespace App\Http\Model{
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
 */
	class Document extends \Eloquent {}
}

namespace App\Http\Model{
/**
 * App\Http\Model\Position
 *
 * @property int $id
 * @property string $nombre
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Position newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Position newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Position query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Position whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Position whereNombre($value)
 * @mixin \Eloquent
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Position whereName($value)
 */
	class Position extends \Eloquent {}
}

namespace App\Http\Model{
/**
 * App\Http\Model\Process
 *
 * @property int $id
 * @property Carbon $begin_date
 * @property string $state_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Http\Model\Action[] $hasAction
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Http\Model\State[] $hasState
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Http\Model\ProcessHasUser[] $hasUser
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Process newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Process newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Process query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Process whereBeginDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Process whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Process whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Process whereStateDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Process whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $active
 * @property int $fk_id_state
 * @property-read \App\Http\Model\State $state
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Process whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Process whereFkIdState($value)
 */
	class Process extends \Eloquent {}
}

namespace App\Http\Model{
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
	class ProcessHasDocument extends \Eloquent {}
}

namespace App\Http\Model{
/**
 * App\Http\Model\ProcessHasUser
 *
 * @property int $id
 * @property string $delivery_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $fk_id_user
 * @property int $fk_id_process
 * @property int $fk_id_rol
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Http\Model\ProcessHasDocument[] $hasDocuments
 * @property-read \App\Http\Model\Process $process
 * @property-read \App\Http\Model\Rol $rol
 * @property-read \App\Http\Model\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\ProcessHasUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\ProcessHasUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\ProcessHasUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\ProcessHasUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\ProcessHasUser whereDeliveryDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\ProcessHasUser whereFkIdProcess($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\ProcessHasUser whereFkIdRol($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\ProcessHasUser whereFkIdUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\ProcessHasUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\ProcessHasUser whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $active
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\ProcessHasUser whereActive($value)
 */
	class ProcessHasUser extends \Eloquent {}
}

namespace App\Http\Model{
/**
 * App\Http\Model\Rol
 *
 * @property int $id
 * @property string $nombre
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Rol newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Rol newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Rol query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Rol whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Rol whereNombre($value)
 * @mixin \Eloquent
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Rol whereName($value)
 */
	class Rol extends \Eloquent {}
}

namespace App\Http\Model{
/**
 * App\Http\Model\State
 *
 * @property int $id
 * @property string $nombre
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\State newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\State newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\State query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\State whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\State whereNombre($value)
 * @mixin \Eloquent
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\State whereName($value)
 */
	class State extends \Eloquent {}
}

namespace App\Http\Model{
/**
 * App\Http\Model\Status
 *
 * @property int $id
 * @property string $nombre
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Status newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Status newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Status query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Status whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Status whereNombre($value)
 * @mixin \Eloquent
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\Status whereName($value)
 */
	class Status extends \Eloquent {}
}

namespace App\Http\Model{
/**
 * App\Http\Model\User
 *
 * @property int $id
 * @property string $name
 * @property string $last_name
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $fk_id_user_type
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Http\Model\ProcessHasUser $processHasUsers
 * @property-read \App\Http\Model\UserType $userType
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\User whereFkIdUserType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\User whereUsername($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Http\Model\Document[] $documents
 * @property-read mixed $full_name
 */
	class User extends \Eloquent {}
}

namespace App\Http\Model{
/**
 * App\Http\Model\UserType
 *
 * @property int $id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\UserType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\UserType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\UserType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\UserType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\UserType whereName($value)
 * @mixin \Eloquent
 */
	class UserType extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @mixin \Eloquent
 */
	class User extends \Eloquent {}
}

