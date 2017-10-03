<?php

namespace App\Traits;

use App\Models\Contracts\Purchasable;

trait CanAccessContent
{
    public function canAccess(Purchasable $model)
    {
        if($this->products->contains($model->getProductIdentifier()) || $this->subscribed('main')) {
            return true;
        }

        return false;
    }

    public function cannotAccess(Purchasable $model)
    {
        return !$this->canAccess($model);
    }
}