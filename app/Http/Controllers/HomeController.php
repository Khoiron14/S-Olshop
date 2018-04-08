<?php

namespace App\Http\Controllers;

use App\Models\Shops\Items\Item;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::latest()->paginate(9);

        return view('home', compact('items'));
    }

    public function search()
    {
        if (request()->q) {
            $items = Item::search(request()->q)->paginate(9);

            return view('home', compact('items'));
        }

        return redirect()->back();
    }
}
