<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class CreditCardResource extends Resource
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
            'card_brand' => $this->card_brand,
            'card_last_four' => $this->card_last_four,
        ];
    }
}
