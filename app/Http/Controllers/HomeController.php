<?php

namespace App\Http\Controllers;

use App\Models\Shops\Items\Item;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

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
