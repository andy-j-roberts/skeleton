<?php

namespace App\Traits;

use App\ProjectSpace;

trait SecureProjectSpace
{
    public function project_space()
    {
        return $this->belongsToMany(ProjectSpace::class);
    }

}