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
        if ($request->file('avatar')) {
            if ($request->user()->avatar) {
                Storage::delete($request->user()->avatar);
            }

            $request->user()->update([
                'avatar' => $request->file('avatar')->store('avatars/users'),
            ]);
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
