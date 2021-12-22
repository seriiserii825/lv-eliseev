@component('mail::message')
# Email Confirmation

Please refer to the following link:

@component('mail::button', ['url' => route('register.verify', ['token' => $user->verify_token])])
    Verify Email, click Me
@endcomponent

{{ config('app.name') }}
@endcomponent
