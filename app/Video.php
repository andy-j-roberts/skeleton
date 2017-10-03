<?php

namespace App;

use App\Traits\GeneratesUuidIdentifier;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use GeneratesUuidIdentifier;

    protected $guarded = [];

    public function products()
    {
        return $this->morphMany(Product::class, 'productable');
    }
}
