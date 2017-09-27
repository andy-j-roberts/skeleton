<?php

namespace App\Traits;

trait Encrytable
{
    public function encryptable($key)
    {
        return in_array($key, $this->encryptable);
    }

    protected function decryptAttribute($value)
    {
        if(!is_null($value)) {
            $value = decrypt($value);
        }

        return $value;
    }

    protected function encryptAttribute($value)
    {
        $value = encrypt($value);
        return $value;
    }

    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);
        if ($this->encryptable($key)) {
            $value = $this->decryptAttribute($value);
        }
        return $value;
    }

    public function setAttribute($key, $value)
    {
        if ($this->encryptable($key)) {
            $value = $this->encryptAttribute($value);
        }
        return parent::setAttribute($key, $value);
    }

    public function getArrayableAttributes()
    {
        $attributes = parent::getArrayableAttributes();
        foreach ($attributes as $key => $attribute) {
            if ($this->encryptable($key)) {
                $attributes[$key] = $this->decryptAttribute($attribute);
            }
        }
        return $attributes;
    }

}