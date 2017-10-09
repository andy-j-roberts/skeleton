<?php

namespace App\Traits;

use App\Media;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

trait MediaCanBeAssociated
{
    protected $presets;

    public function media()
    {
        return $this->morphMany(Media::class, 'model');
    }

    public function addMediaFromRequest($key)
    {
        $file     = request()->file($key);
        $filename = $file->getClientOriginalName();
        $file->storeAs('uploads', $filename, 'public');
        $media = $this->createMedia($file, $filename);
        $this->manipulateMedia($media, $file, $filename);

        return $this;
    }

    protected function createMedia($file, $filename)
    {
        $media = new Media([
            'name'              => $filename,
            'file_name'         => $file->getClientOriginalName(),
            'mime_type'         => $file->getClientMimeType(),
            'size'              => $file->getClientSize(),
            'manipulations'     => [],
            'custom_properties' => []
        ]);
        $this->media()->save($media);

        return $media;
    }

    public function addPreset($preset)
    {
        if ( ! $this->presets) {
            $this->presets = collect();
        }
        $this->presets->push($preset);
    }

    protected function manipulateMedia($media, $file, $filename)
    {
        $this->registerMediaPresets();
        foreach ($this->presets as $preset) {
            $image = Image::make($file)->resize($preset->getWidth(), $preset->getHeight());
            Storage::disk('public')->put("thumbnails/{$preset->getPresetName()}_{$filename}", $image->encode('jpg', 75),
                'public');
        }
        $media->update(['manipulations' => $this->presets->pluck('preset_name')]);
    }


}