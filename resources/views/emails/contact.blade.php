@component('mail::message')
Thanks for your message to Denmead Archery Club.

The body of your message.

{{ $email->content }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
