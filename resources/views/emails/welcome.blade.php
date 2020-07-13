@component('mail::message')
# Vue JS with Laravel API

The body of your message.
<p>{{ $data['body'] }}</p>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
