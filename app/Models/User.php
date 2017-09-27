<?php

namespace App\Models;

use App\Traits\GeneratesUuidIdentifier;
use App\Traits\HasRoles;
use App\Traits\Verifiable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable;
    use GeneratesUuidIdentifier;
    use HasRoles;
    use Verifiable;
    use HasApiTokens;
    use Billable;

    protected $guarded = [];
    protected $dates = ['last_login'];
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
