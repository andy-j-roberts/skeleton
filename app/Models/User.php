<?php

namespace App\Models;

use App\Traits\GeneratesUuidIdentifier;
use App\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use GeneratesUuidIdentifier;
    use HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $with = ['roles'];

    public $incrementing = false;

    public function getAvatarAttribute()
    {
        $avatarEmail = md5( strtolower(trim($this->email)));

        return "https://www.gravatar.com/avatar/{$avatarEmail}?size=80&default=retro";
    }
}
