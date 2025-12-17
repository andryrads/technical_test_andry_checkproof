@component('mail::message')
Hi {{ $name }},

Your account is ready and you can now use **{{ $email }}** to sign in.

Thanks,  
{{ config('app.name') }}
@endcomponent
