<?php

namespace App\Traits;

use Ramsey\Uuid\Uuid;

trait GeneratesUuidIdentifier
{

    public static function bootGeneratesUuidIdentifier()
    {
        static::creating(function ($model) {
            $model->incrementing = false;
            $model->attributes[$model->getKeyName()] = (string)$model->generateNewUuid();
        });
    }

    public function generateNewUuid()
    {
        return Uuid::uuid4();
    }

    public function getIncrementing()
    {
        return false;
    }
}