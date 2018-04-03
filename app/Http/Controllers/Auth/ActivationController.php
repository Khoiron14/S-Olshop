<?php

namespace App\Http\Controllers\Auth;

use App\Models\Users\User;
use App\Http\Controllers\Controller;

class ActivationController extends Controller
{
    public function activate()
    {
        $user = User::byActivationColumns(request()->email, request()->token)->firstOrFail();

        $user->update([
            'active' => true,
            'activation_token' => null,
        ]);

        auth()->loginUsingId($user->id);

        alert()->success('You\'re now signed in.', 'Activated!')->persistent('Ok');

        return redirect()->route('home');
    }
}
