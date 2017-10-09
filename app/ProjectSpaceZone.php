<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectSpaceZone extends Model
{
    protected $guarded = [];
    protected $with = ['zoneable'];

    public function project_space()
    {
        return $this->belongsTo(ProjectSpace::class);
    }

    public function zoneable()
    {
        return $this->morphTo();
    }

    public function getZoneTypeAttribute()
    {
        $model = new \ReflectionClass($this->zoneable_type);

        return $model->getShortName();
    }
}
