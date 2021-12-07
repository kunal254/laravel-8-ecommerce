<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductDetailsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Product $product)
    {
        if(Auth::check())
        {
            /** @var \App\Models\User $user **/
            $user = Auth::user();
            $cart = $user->carts()->firstOrCreate(['status' => 'N']);

            $isAdded = $cart->products->contains($product);
        }
        else
            $isAdded = array_key_exists($product->id, json_decode($request->cookie('products'), true) ?? []); 

        return view('product', [
            'product' => $product,
            'isAdded' => $isAdded
        ]);    
    }

}
