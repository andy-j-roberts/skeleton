<?php

namespace App\Http\Resources;

use App\Plan;
use Illuminate\Http\Resources\Json\Resource;

class SubscriptionResource extends Resource
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
            'id' => $this->id,
            'stripe_id' => $this->stripe_id,
            'ends_at' => $this->ends_at ? $this->ends_at->format('dS M Y @ h:i') : null,
            'plan' => new PlanResource(Plan::whereStripeId($this->stripe_plan)->first()),
        ];
    }
}
