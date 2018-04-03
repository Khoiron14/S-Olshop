<?php

namespace App\Http\Controllers\Users;

use App\Models\Users\Cart;
use App\Models\Shops\Items\Item;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $carts = auth()->user()->carts()->get();

        return view('user.cart', compact('carts'));
    }

    public function store(Item $item)
    {
        $cart = auth()->user()->carts()->whereItemId($item->id)->first();

        if ($cart) {
            $cart->update([
                'quantity' => $cart->quantity + Cart::MINIMUM_QUANTITY,
            ]);
        } else {
            auth()->user()->carts()->create([
                'item_id' => $item->id,
                'quantity' => Cart::MINIMUM_QUANTITY,
            ]);
        }

        return redirect()->back();
    }

    public function destroy(Item $item)
    {
        $cart = auth()->user()->carts()->whereItemId($item->id)->first();

        if ($cart->quantity > Cart::MINIMUM_QUANTITY) {
            $cart->update([
                'quantity' => $cart->quantity - Cart::MINIMUM_QUANTITY,
            ]);

            return redirect()->back();
        }

        $cart->delete();

        return redirect()->back();
    }
}
