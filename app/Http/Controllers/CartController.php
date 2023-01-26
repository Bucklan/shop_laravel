<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function buy()
    {
        $bool = false;
        $price = 0;
        $qwert = Auth::user()->shopsWithStatus('in_cart')->get();
        foreach ($qwert as $q) {
            $price += $q->pivot->number * $q->price;
        }
        foreach ($qwert as $q) {
            if ($q->pivot->number != 0 && $price <= Auth::user()->my_balance) {
                $bool = true;
            }
        }
        if ($bool) {
            $ids = Auth::user()->shopsWithStatus('in_cart')->get();
            foreach ($ids as $id) {
                Auth::user()->shopsWithStatus('in_cart')->updateExistingPivot($id, ['status' => 'ordered']);
            }
            Auth::user()->update(['my_balance' => Auth::user()->my_balance - $price]);
            return back()->with('message', __('alerts.Your cart successfully sended'));

        }
        return back()->withErrors(__('alerts.you don`t have enough money'));
    }

    public function index()
    {
        $shopsInCart = Auth::user()->shopsWithStatus('in_cart')->where('number', '>', 0)->get();
        $shopsIsNull = Auth::user()->shopsWithStatus('in_cart')->where('number', '<=', 0)->get();
        for ($i = 0; $i < count($shopsIsNull); $i++) {
            if ($shopsIsNull[$i]->pivot->number <= 0 && $shopsIsNull[$i] != null) {
                $this->deleteFromCart($shopsIsNull[$i]);
                return back();
            }
        }
        $total = 0;
        for ($i = 0; $i < count($shopsInCart); $i++) {
            $total = $total + $shopsInCart[$i]->price * $shopsInCart[$i]->pivot->number;
        }
        for ($i = 0; $i < count($shopsInCart); $i++) {
            if ($shopsInCart[$i]) {
                return view('cart.index', ['shopsInCart' => $shopsInCart, 'total' => $total]);
            }
        }
        return view('cart.index', ['shopsInNull' => true]);
    }

    public function putToCart(Shop $shop)
    {

        $shopsInCart = Auth::user()->shopsWithStatus('in_cart')->where('shop_id', $shop->id)->first();
        if ($shopsInCart != null) {
            Auth::user()->shopsWithStatus('in_cart')
                ->updateExistingPivot($shop->id,
                    ['number' => $shopsInCart->pivot->number + 1]);
        } else {
            Auth::user()->shopsWithStatus('in_cart')->attach($shop->id, ['number' => 1]);
        }
        return redirect()->route('cart.index')->with('message',__('alerts.Your products successfully saved is cart'));
    }

    public function deleteFromCart(Shop $shop)
    {
        $shopsBought = Auth::user()->shopsWithStatus('in_cart')->where('shop_id', $shop->id)->first();
        if ($shopsBought != null)
            Auth::user()->shopsWithStatus('in_cart')->detach($shop->id);
        return back()->with('message',__('alerts.Your cart column successfully deleted'));
    }

    public function remove(Shop $shop)
    {
        $shopsInCart = Auth::user()->shopsWithStatus('in_cart')->where('shop_id', $shop->id)->first();
        if ($shopsInCart != null) {
            Auth::user()->shopsWithStatus('in_cart')
                ->updateExistingPivot($shop->id,
                    ['number' => $shopsInCart->pivot->number - 1]);
        } else {
            Auth::user()->shopsWithStatus('in_cart')->attach($shop->id, ['number' => 1]);
        }
        return back()->with('message',__('alerts.Your cart column successfully deleted'));

    }
    public function deleteallcart()
    {
        $shopsBought = Auth::user()->shopsWithStatus('in_cart')->get();
        if ($shopsBought != null)
            Auth::user()->shopsWithStatus('in_cart')->detach();
        return redirect()->route('cart.index')->with('message', 'alerts.Your cart column successfully deleted');
    }
}

