<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Str;

class SuperController extends Controller
{
    public function index (): \Inertia\Response
    {
        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
        ]);
    }

    public function dashboard ()
    {
        return Inertia::render('Dashboard');
    }

    public function getCart()
    {
        $time =  time() + (86400 * 9999);
        $uuid = Str::uuid()->toString();
        if(!isset($_COOKIE["uuid"])) {
            setcookie("uuid", $uuid, $time);
            $cart = Cart::create([
                'uuid' => $uuid,
                'user_id' => Auth::check() == true ? Auth::id() : null
            ]);
        } else {
            $cookieCart = Cart::where('uuid', $_COOKIE['uuid'])->first();
            if (Auth::check()) {
                if ($cookieCart->user_id == null) {
                    $updateCart = $cookieCart->update(['user_id' => Auth::id()]);
                    $cookieCart = $updateCart;
                } else if ($cookieCart->user_id != Auth::id()) {
                    setcookie("uuid", $uuid, $time);
                    $newCart = Cart::create([
                        'uuid' => $uuid,
                        'user_id' =>Auth::id()
                    ]);
                    foreach($cookieCart->products as $product)
                    {
                       $newCart->products()->attach($product->id,
                           ['variant_id' => $product->pivot->variant_id, 'quantity' => $product->pivot->quantity]);
                    }
                    $cookieCart = $newCart;
                }
            }
            $cart = $cookieCart;
        }
        return $cart;
    }

    public function makeCookie (Request $request)
    {
        $cart = $this->getCart();
        $pro = $cart->products()->where([
            ['product_id', '=', 1],
            ['variant_id', '=', 1]
        ])->first();

        if ($pro != null){
            $pro->pivot->increment('quantity');
        } else {
            $cart->products()->syncWithoutDetaching([1 => ['variant_id' => 1]]);
        }
        dd($cart->products, $pro->pivot->quantity);
    }

}
