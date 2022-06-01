@extends('template_defined')

@section('content')
<br>
@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif
<br>
<form action="{{ route('founded_exhibitions') }}" method="GET">
        <label for="name">Exhibition:</label><input type="text" name="name">
        <label for="aut">Organizer:</label><input type="text" name="organizer">
        <label for="type">Exhibition type:</label><select name="type">
            <option>All</option>
            <option>Active</option>
            <option>Scheduled</option>
        </select>
        <input type="submit" name="search" value="Search" >
</form>
<hr>
<br>
@if(empty($searched))
<h2>All Exhibitions:</h2>
@else
<h2>Founded Exhibitions:</h2>
@endif

<table>
    <tr>
        <th>Exhibition</th>
        <th>Links</th>
    </tr>
    @foreach ( $exhibitions as $exhibition )
        <tr>
            <td>
                {{ $exhibition->Name }}
            </td>
            <td>
                <a href="{{ route('exhibition', ['id' => $exhibition->IDExh ])  }}">Exhibiton: {{ $exhibition->Name }}</a> 
            </td>
        </tr>
    @endforeach
</table>
@endsection