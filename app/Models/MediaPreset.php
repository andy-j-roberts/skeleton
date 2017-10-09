<?php

namespace App\Models;

class MediaPreset
{
    public $preset_name;
    protected $width;
    protected $height;

    public function __construct($preset_name, $width, $height)
    {
        $this->preset_name = $preset_name;
        $this->width       = $width;
        $this->height      = $height;
    }

    public function getPresetName()
    {
        return $this->preset_name;
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function getHeight()
    {
        return $this->height;
    }
}