<?php

namespace App\Listeners;

use Carbon\Carbon;

class UpdateUsersLoginDate
{
    public function handle($event)
    {
        $event->user->update(['last_login' => Carbon::now()]);
    }
}
