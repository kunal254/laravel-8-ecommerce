<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request)
    {
        try {
            $request->authenticate();
        } catch (ValidationException $th) {
            return back()->with('status', $th->errors()['email'][0] );
        }

        $request->session()->regenerate();

        $this->syncUserCart($request);
        return redirect()->intended(RouteServiceProvider::HOME)->withCookie(cookie('products','',-1));

    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    private function syncUserCart(Request $request){
        $cart = json_decode($request->cookie('products'), true);
        if(! $cart)
            return;
        
        /** @var \App\Models\User $user **/
        $user = Auth::user();
        $userCart = $user->carts()->firstOrCreate(['status' => 'N']);

        foreach ($cart as $id => $quantity) {
            if($userCart->products->contains($id))
            {
                $totalQuantity = $userCart->products()->firstWhere('product_id', $id)->pivot->quantity + $quantity;

                $userCart->products()->updateExistingPivot($id, [
                    'quantity' =>  $totalQuantity
                ]);

                continue;
            }
            
            $userCart->products()->attach($id, ['quantity' => $quantity, 'discount' => 0]);
        }
    }
}