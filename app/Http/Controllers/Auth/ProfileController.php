<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Request $request)
    {
        if (! $request->user()->hasRole('user')) {
            return redirect()->route('home');
        }

        return view('user.profile');
    }
}
