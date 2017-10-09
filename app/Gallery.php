<?php

namespace App;

use App\Models\Contracts\ManipulatesMedia;
use App\Models\MediaPreset;
use App\Traits\GeneratesUuidIdentifier;
use App\Traits\MediaCanBeAssociated;
use App\Traits\Zoneable;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model implements ManipulatesMedia
{
    use GeneratesUuidIdentifier;
    use Zoneable;
    use MediaCanBeAssociated;

    protected $guarded = [];

    public function registerMediaPresets()
    {
        $this->addPreset(new MediaPreset('thumb', '300', '200'));
        $this->addPreset(new MediaPreset('sm', '256', '256'));
    }
}
