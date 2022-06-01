@extends('template_defined')

@section('content')
<br>
@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif


<div class="searched_exhibtions">
    <div class="searchbar_exhibition">
        <form action="{{ route('found_exhibitions') }}" method="GET">
            <label for="name">Exhibition:</label><input type="text" name="name">
            <label for="type">Exhibition type:</label><select name="type">
                <option>All</option>
                <option>Active</option>
                <option>Scheduled</option>
            </select>
            <input type="submit" name="search" value="Search" >
        </form>
    </div>
    <div class="exhibitions_content">
        <div class="tittle">
            @if(empty($searched))
            <h2>All Exhibitions:</h2>
            @else
            <h2>Found Exhibitions:</h2>
            @endif
        </div>
    
        <div class="exhibitions">
            <table>
                <tr>
                    <th>Exhibitions</th>
                    <th>Links</th>
                </tr>
                @foreach ( $exhibitions as $exhibition )
                    <tr>
                        <td>
                            {{ $exhibition->Name }}
                        </td>
                        <td>
                            <a href="{{ route('exhibition', ['id' => $exhibition->IDExh ])  }}">Exhibition  {{ $exhibition->Name }}</a> 
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection