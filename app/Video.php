<?php

namespace App;

use App\Models\Contracts\Purchasable;
use App\Traits\GeneratesUuidIdentifier;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Video extends Model implements Purchasable
{
    use GeneratesUuidIdentifier;
    use HasSlug;

    protected $guarded = [];
    protected $appends = ['path'];

    public function product()
    {
        return $this->morphOne(Product::class, 'productable');
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
                          ->generateSlugsFrom('name')
                          ->saveSlugsTo('permalink');
    }

    public function path()
    {
        return url("/videos/{$this->attributes['permalink']}");
    }

    public function getPathAttribute()
    {
        return $this->path();
    }

    public function getProductIdentifier()
    {
        return $this->product->id;
    }

}
