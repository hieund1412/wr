<?php

namespace Modules\Auth\Entities;

use Core\BaseModel as Eloquent;

/**
 * Class PasswordReset
 *
 * @property int $id
 * @property string $email
 * @property string $token
 * @property \Carbon\Carbon $created_at
 *
 * @package App\Models
 */
class PasswordResets extends Eloquent
{
    public $timestamps = false;

    protected $hidden = [
        'token'
    ];

    protected $fillable = [
        'email',
        'token'
    ];
}