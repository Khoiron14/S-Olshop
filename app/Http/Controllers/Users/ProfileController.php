<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        return view('user.profile');
    }
}
