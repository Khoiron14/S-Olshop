<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Item\Item;

class CartController extends Controller
{
    public function index()
    {
        $carts = auth()->user()->carts()->get();

        return view('user.cart', compact('carts'));
    }

    public function store(Item $item)
    {
        if (!auth()->user()->hasRole('user')) {
            return redirect()->back();
        }

        $cart = auth()->user()->carts()->whereItemId($item->id)->first();

        if ($cart) {
            $cart->update([
                'quantity' => $cart->quantity + 1,
            ]);
        } else {
            $cart = auth()->user()->carts()->create([
                'item_id' => $item->id,
                'quantity' => 1,
            ]);
        }

        return redirect()->back();
    }

    public function destroy(Item $item)
    {
        if (!auth()->user()->hasRole('user')) {
            return redirect()->back();
        }

        $cart = auth()->user()->carts()->first();

        if ($cart->quantity > 1) {
            $cart->update([
                'quantity' => $cart->quantity - 1,
            ]);

            return redirect()->back();
        }

        $cart->delete();

        return redirect()->back();
    }
}
