<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    
    public function index(Request $req)
    {
        if(Auth::check())
        {
            /** @var \App\Models\User $user **/
            $user = Auth::user();
            $cart = $user->carts()->firstOrCreate(['status' => 'N']);
            $products = $cart->products->map(function($product){
                $product->quantity = $product->pivot->quantity;
                return $product;
            });
        }
        else
        {
            $cart = json_decode($req->cookie('products'), true);
            $products = Product::findMany(array_keys($cart ?? []));

            $products = $products->map(function($product) use($cart){
                $product->quantity = $cart[$product->id];
                return $product;
            });
        }


        return view('cart',[
            'products' => $products
        ]);

    }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {
        /** @var \App\Models\User $user **/
        $user = Auth::user();
        $cart = $user->carts()->firstOrCreate(['status' => 'N']);
        
        if(! $cart->products->contains($product))
            $cart->products()->attach($product->id, ['quantity' => 1, 'discount' => 0]);

        return back();
        
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Models\Cart  $cart
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(Cart $cart)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\Models\Cart  $cart
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit(Cart $cart)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product, $quantity)
    {
        /** @var \App\Models\User $user **/
        $user = Auth::user();
        $cart = $user->carts()->firstOrCreate(['status' => 'N']);

        if($cart->products->contains($product))
            $cart->products()->updateExistingPivot($product->id, [
                'quantity' =>  $quantity
            ]);
            
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        /** @var \App\Models\User $user **/
        $user = Auth::user();
        $cart = $user->carts()->firstOrCreate(['status' => 'N']);

        if($cart->products->contains($product))
            $cart->products()->detach($product->id);

        return back();
    }
}
