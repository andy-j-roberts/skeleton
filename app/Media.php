<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    protected $table = 'media';
    protected $guarded = [];
    protected $casts = [
        'manipulations'     => 'array',
        'custom_properties' => 'array'
    ];

    public function model()
    {
        return $this->morphTo();
    }

    public function getPresetPath($preset)
    {
        if ( ! in_array($preset, $this->manipulations)) {

            return $this->getPath();
        }

        return Storage::url('thumbnails/' . $preset . '_' . $this->file_name);
    }

    public function getPath()
    {
        return Storage::url('uploads/' . $this->file_name);
    }
}
