<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Stripe\Stripe;
use Stripe\Plan as StripePlan;
use Stripe\Subscription as StripeSubscription;

class Plan extends Model
{
    protected $guarded = [];
    protected $casts = ['metadata' => 'json'];
    const CURRENCIES = ['gbp' => '£'];

    public function setAmountAttribute($value)
    {
        $this->attributes['amount'] = str_replace('.','', $value);
    }

    public function getAmountAsCurrency()
    {
        return self::CURRENCIES[$this->currency] . number_format($this->amount / pow(10, 2), 2);
    }

    public function getMetadata($key)
    {
        return $this->metadata[$key] ?? '';
    }

    public function syncWithStripe()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
        StripePlan::create([
            "amount"   => $this->amount,
            "interval" => $this->interval,
            "name"     => $this->name,
            "currency" => $this->currency,
            "id"       => $this->stripe_id
        ]);
    }

    public function getSubscriptions()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
        return StripeSubscription::all(['plan' => $this->stripe_id]);
    }


}
