<?php

namespace App\Http\Controllers\Auth;

use Storage;
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
        if ($request->file('image')) {
            if ($request->user()->image()) {
                Storage::delete($request->user()->image()->first()->path);
            }

            $image = $request->file('image')->store('avatars/users');
            $request->user()->image()->update(['path' => $image]);
        }

        auth()->user()->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        alert()->success('Profile has been updated!');

        return redirect()->route('user.profile');
    }
}
