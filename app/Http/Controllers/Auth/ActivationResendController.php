<?php

namespace App\Http\Controllers\Auth;

use App\Events\Users\ActivationEmail;
use App\Models\Users\User;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;


class ActivationResendController extends Controller
{
    public function showResendForm()
    {
        return view('auth.activate.resend');
    }

    public function resend()
    {
        $this->validateResendRequest();

        $user = User::whereEmail(request()->email)->first();

        event(new ActivationEmail($user));

        alert()->success('Email activation has been resent.')->persistent('Ok');

        return redirect()->route('login');
    }

    /**
     * Validate the resend request.
     *
     * @return void
     */
    protected function validateResendRequest()
    {
        $this->validate(request(), [
            'email' => [
                'required',
                'email',
                Rule::exists('users')->where(function ($query) {
                    $query->whereActive(false);
                })
            ]
        ], $this->validationError());
    }

    /**
     * Get validation error for resend request
     * 
     * @return array
     */
    public function validationError()
    {
        return [
            'email.exists' => 'The selected email is invalid or already active.'
        ];
    }
}
