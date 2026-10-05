@component('mail::message')
# Welcome, {{ $user->name }}!

We are excited to have you on board. Please click the link below to set your password and get started:

@component('mail::button', ['url' => $resetUrl])
Set Your Password
@endcomponent

If you did not sign up for this account, please ignore this email.

Thank you,  
**FMD**
@endcomponent
