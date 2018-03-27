@component('mail::message')
# Activation your account

Thanks for signing up, please activate your account.

@component('mail::button', ['url' => route('user.activate', [
        'token' => $user->activation_token,
        'email' => $user->email
    ])
])
Activate
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
