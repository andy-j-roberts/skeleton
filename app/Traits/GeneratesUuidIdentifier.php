<?php

namespace App\Traits;

use Ramsey\Uuid\Uuid;

trait GeneratesUuidIdentifier
{

    public static function bootGeneratesUuidIdentifier()
    {
        static::creating(function ($model) {
            $model->attributes[$model->getKeyName()] = (string)$model->generateNewUuid();
        });
    }

    public function generateNewUuid()
    {
        return Uuid::uuid4();
    }
}