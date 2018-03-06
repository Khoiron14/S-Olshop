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
        $items = Item::all()->sortByDesc('updated_at');

        return view('home', compact('items'));
    }
}
