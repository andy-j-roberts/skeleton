<?php

namespace App;

use App\Traits\GeneratesUuidIdentifier;
use Illuminate\Database\Eloquent\Model;
use Laravel\Cashier\Cashier;

class Product extends Model
{
    use GeneratesUuidIdentifier;

    protected $guarded = [];

    public function productable()
    {
        return $this->morphTo();
    }

    public function getFormattedAmountAttribute()
    {
        return Cashier::formatAmount($this->amount);
    }
}
