<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\Rule;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        if (!session()->has('from')) {
            session()->put('from', url()->previous());
        }

        return view('auth.login');
    }

    /**
     * Validate the user login request.
     *
     * @return void
     */
    protected function validateLogin()
    {
        $this->validate(request(), [
            $this->username() => [
                'required',
                'string',
                Rule::exists('users')->where(function ($query) {
                    $query->whereActive(true);
                })
            ],
            'password' => 'required|string',
        ], $this->validationError());
    }

    /**
     * Get validation error for login
     * 
     * @return array
     */
    public function validationError()
    {
        return [
            $this->username() . '.exists' => 'The selected email is invalid or you need to activate your account.'
        ];
    }

    public function authenticated($request,$user)
    {
        return redirect(session()->pull('from',$this->redirectTo));
    }


}
