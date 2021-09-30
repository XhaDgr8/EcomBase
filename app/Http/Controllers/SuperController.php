<?php

namespace App\Http\Controllers;

use App\Models\Cart;
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
        if(!isset($_COOKIE["uuid"])) {
            $time =  time() + (86400 * 9999);
            $uuid = Str::uuid()->toString();
            setcookie("uuid", $uuid, $time);
            if (Auth::check()){
                $cart = Cart::create(['uuid' => $uuid],['user_id' => auth()->user()->id]);
            } else {
                $cart = Cart::create(['uuid' => $uuid]);
            }
        } else {
            if (Auth::check()){
                $cart = Cart::create(['uuid' => $_COOKIE["uuid"]],['user_id' => auth()->user()->id]);
            } else {
                $cart = Cart::create(['uuid' =>  $_COOKIE["uuid"]]);
            }
        }
        return $cart;
    }

    public function makeCookie (Request $request)
    {
        $cart = $this->getCart();
        dd($cart);
    }
}
