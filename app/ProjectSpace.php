<?php

namespace App;

use App\Models\User;
use App\Traits\Encrytable;
use App\Traits\GeneratesUuidIdentifier;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class ProjectSpace extends Model
{
    use GeneratesUuidIdentifier;
    use HasSlug;
    use Encrytable;

    protected $encryptable = ['password'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
                          ->generateSlugsFrom('name')
                          ->saveSlugsTo('permalink');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function zones()
    {
        return $this->hasMany(ProjectSpaceZone::class);
    }

    public function addZone($model)
    {
        $zone = new ProjectSpaceZone();
        $zone->project_space()->associate($this);
        $model->zone()->save($zone);

        return $this;
    }
}
