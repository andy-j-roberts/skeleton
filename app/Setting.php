<?php

namespace App;

use App\Traits\Encrytable;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use Encrytable;

    protected $guarded = [];
    protected $encryptable = ['value'];
}
