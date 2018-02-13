<?php

namespace App\Http\Controllers\Auth;

use Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UpdateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function update(Request $request)
    {
        if ($request->file('image')) {
            if ($request->user()->image()) {
                Storage::delete($request->user()->image()->first()->path);
            }

            $image = $request->file('image')->store('avatars/users');
            $request->user()->image()->update(['path' => $image]);
        }

        auth()->user()->update([
            'name'      => $request->name,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'address'   => $request->address,
        ]);

        return redirect()->route('user.profile')->withInfo('Profile has been updated!');
    }
}
