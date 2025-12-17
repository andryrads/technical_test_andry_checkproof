@component('mail::message')
Hello,

A new user has just been added to the system.

Here are the details:
- **Name:** {{ $name }}
- **Email:** {{ $email }}
- **Role:** {{ $role }}

Best regards,  
{{ config('app.name') }}
@endcomponent

