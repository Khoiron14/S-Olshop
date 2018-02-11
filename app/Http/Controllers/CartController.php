<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Item\Item;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $carts = Cart::where('user_id', $request->user()->id)->get();

        return view('user.cart', compact('carts'));
    }

    public function store(Request $request, Item $item)
    {
        if (!$request->user()->hasRole('user')) {
            return redirect()->back();
        }

        $cart = Cart::where([['user_id', $request->user()->id], ['item_id', $item->id]])->first();

        if ($cart) {
            $cart->update([
                'quantity' => $cart->quantity + 1,
            ]);
        } else {
            $cart = Cart::create([
                'user_id' => $request->user()->id,
                'item_id' => $item->id,
                'quantity' => 1,
            ]);
        }

        return redirect()->back();
    }

    public function destroy(Request $request, Item $item)
    {
        if (!$request->user()->hasRole('user')) {
            return redirect()->back();
        }

        $cart = Cart::where([['user_id', $request->user()->id], ['item_id', $item->id]])->first();

        if ($cart->quantity > 1) {
            $cart->update([
                'quantity' => $cart->quantity - 1,
            ]);

            return redirect()->back();
        } else {
            $cart->delete();

            return redirect()->back();
        }
    }
}
