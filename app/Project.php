<?php

namespace App;

use App\Traits\Encrytable;
use App\Traits\GeneratesUuidIdentifier;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Project extends Model
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


    public function clients()
    {
        return $this->belongsToMany(Client::class);
    }

    public function product()
    {
        return $this->morphMany(Product::class, 'productable');
    }

}
