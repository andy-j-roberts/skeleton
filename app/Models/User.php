<?php

namespace App\Models;

use App\Product;
use App\Traits\CanAccessContent;
use App\Traits\GeneratesUuidIdentifier;
use App\Traits\HasRoles;
use App\Traits\Verifiable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;
use Laravel\Passport\HasApiTokens;
use Laravel\Scout\Searchable;

class User extends Authenticatable
{
    use Notifiable;
    use GeneratesUuidIdentifier;
    use HasRoles;
    use Verifiable;
    use HasApiTokens;
    use Billable;
    use CanAccessContent;
    use Searchable;

    protected $guarded = [];
    protected $dates = ['last_login'];
    protected $hidden = [
        'stripe_id',
        'password',
        'remember_token',
    ];
    protected $with = ['roles'];

    public $incrementing = false;

    public function getAvatarAttribute()
    {
        $avatarEmail = md5(strtolower(trim($this->email)));

        return "https://www.gravatar.com/avatar/{$avatarEmail}?size=80&default=retro";
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'user_products', 'user_id', 'product_id')->withTimestamps();
    }

    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'roles' => $this->roles,
        ];
    }
}
