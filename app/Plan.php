<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $guarded = [];
    protected $appends = ['currency'];

    public function getAmountAsCurrency()
    {
        return number_format($this->amount / pow(10,2), 2);
    }

}
