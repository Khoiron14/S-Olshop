<?php

namespace App\Http\Controllers\Auth;

use App\Models\Shops\Store;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('role:admin');
    }

    public function index(Request $request)
    {
        $stores = Store::with('user')->get();

        return view('admin.index', compact('stores'));
    }
}
