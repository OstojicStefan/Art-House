@component('mail::message')
# Your picture has been successfully sold!

Auction name: {{ $auction->Name }} <br>
@if(!empty($buyer))
Buyer: {{ $buyer->Username }} <br>
@endif 
Price: {{ $auction->Price }} <br>
Views: {{ $auction->ViewCount }} <br>
<br>
<br>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
