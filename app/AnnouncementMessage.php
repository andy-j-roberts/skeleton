<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnnouncementMessage extends Model
{
    protected $guarded = [];

    public function setUserAttribute($user)
    {
        $this->user_id = $user->id;
    }
}
