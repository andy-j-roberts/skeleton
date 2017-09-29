<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class PlanResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'stripe_id' => $this->stripe_id,
            'name' => $this->name,
            'amount' => $this->getAmountAsCurrency(),
            'interval' => $this->interval,
            'description' => $this->getMetadata('description'),
        ];
    }
}
