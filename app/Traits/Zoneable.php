<?php

namespace App\Traits;

use App\ProjectSpaceZone;

trait Zoneable
{
    public function zone()
    {
        return $this->morphOne(ProjectSpaceZone::class, 'zoneable');
    }
}