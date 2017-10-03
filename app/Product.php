<?php

namespace App;

use App\Traits\GeneratesUuidIdentifier;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use GeneratesUuidIdentifier;
    protected $guarded = [];
    public function productable()
    {
        return $this->morphTo();
    }
}
