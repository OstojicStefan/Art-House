@component('mail::message')
# You need to check these out!

<table>
    <tr>
        <th>Painting</th>
        <th>Author</th>
        <th>Links</th>
    </tr>
    @foreach ( $auctions as $auction )
        <tr>
            <td>
                {{ $auction->Name }}
            </td>
            <td>
                {{ $auction->Author }}
            </td>
            <td>
                <a href="{{ route('auction', ['id' => $auction->IDAuc ])  }}">Auction for {{ $auction->Name }}</a> 
            </td>
        </tr>
    @endforeach
</table>

<br>
<br>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
