<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class PurchaseProductsController extends Controller
{
    public function __invoke(Product $product, Request $request)
    {
        $user = auth()->user();
        $invoice = $user->invoiceFor($product->name, $product->amount);
        if($invoice) {
            $user->products()->attach($product->id, ['invoice_id' => $invoice->id]);
        }

        return response()->json(['status' => 'OK']);
    }
}
