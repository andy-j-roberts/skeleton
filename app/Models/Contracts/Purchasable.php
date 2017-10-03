<?php

namespace App\Models\Contracts;

interface Purchasable {

    public function product();
    public function getProductIdentifier();
}