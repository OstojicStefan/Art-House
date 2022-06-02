@component('mail::message')
# Congratulations on an excellent show!

@if($flag_donations == 1)
Accumulated Donations: {{ $donations }}<br>
@endif
Rating: {{ $rating }}<br>
Number of votes: {{ $rating_count }}<br>
<br>
<br>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
