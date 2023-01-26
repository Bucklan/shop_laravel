<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Models\Cart;

class AdminController extends Controller
{
    public function confirm(Cart $cart){
        $cart->update([
            'status'=>'confirmed'
        ]);
        return back();
    }
    public function cart(){
        $shopsInCart=Cart::where('status','ordered')->with(['shop','user'])->get();
        return view('adm.cart',['shopsInCart'=>$shopsInCart]);
    }

}
