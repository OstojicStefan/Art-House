@extends('template_defined')

@section('content')
<br>
<br>
<br>
<form action="{{ route('founded_auctions') }}"  method="GET">
    <label for="">The painting:</label><input type="text" name="name">
    <label>Author:</label><input type="text" name="author">
    {{-- popuni preko php-a --}}
    <select name="tag" >
        <option>Tags</option>
        <option>Modern</option>
        <option>Portrait</option>
        <option>Apstract</option>
        <option>Scenery</option>
        <option>Photoshop</option>
        <option>Nature</option>
        <option>Family</option>
        <option>Animals</option>
    </select>
    <select name="type" >
        <option >All</option>
        <option >Physical</option>
        <option >Virtual</option>
    </select>
    <select name="status">
        <option >All</option>
        <option >Active</option>
        <option >Expired</option>
    </select>
    <input type="submit" value="Search">
</form>
<hr>
<br>
@if(empty($searched))
<h2>All Auctions:</h2>
@else
<h2>Founded Auctions:</h2>
@endif

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
@endsection