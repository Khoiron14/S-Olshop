<?php

namespace App\Http\Controllers\Auth;

use App\Events\Users\Updated;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;

class UpdateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        return view('auth.edit');
    }

    public function update(UserRequest $request)
    {
        if (auth()->user()->isNameDefault()) {
            $name = $request->name;
        } else {
            $name = auth()->user()->name;
        }

        auth()->user()->update([
            'name' => $name,
            'email' => $request->email,
        ]);

        event(new Updated(auth()->user()));

        alert()->success('Profile has been updated!');

        return redirect()->route('user.profile');
    }
}
