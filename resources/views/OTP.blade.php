@component('mail::message')
# Book Express

Your OTP is {{ $OTP }}


Thanks,<br>
{{ config('app.name') }}
@endcomponent
