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

    public function update(UserRequest $request)
    {
        auth()->user()->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        event(new Updated(auth()->user()));

        alert()->success('Profile has been updated!');

        return redirect()->route('user.profile');
    }
}
