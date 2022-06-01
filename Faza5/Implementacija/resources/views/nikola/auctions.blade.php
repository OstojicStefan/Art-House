@extends('template_defined')

@section('content')

@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif

<div class="auctions_content">
    <div class="searchbar">
        <form action="{{ route('found_auctions') }}"  method="GET">
            <div>
                <label for="">The painting:</label><input type="text" name="name">
                <label>Author:</label><input type="text" name="author">
            </div>
            <div>
                Tag:<select name="tag" >
                    <option >All</option>
                    @foreach ($tags as $tag )
                        <option value = "{{ $tag->Name }}">{{ $tag->Name }}</option>
                    @endforeach
                </select>
                Type:<select name="type" >
                    <option >All</option>
                    <option >Physical</option>
                    <option >Virtual</option>
                </select>
                Status:<select name="status">
                    <option >All</option>
                    <option >Active</option>
                    <option >Expired</option>
                </select>
            </div>
            <div>
                <input type="submit" value="Search">
            </div>
        </form>
    </div>
    
    <div class="searched_auctions">
        <div class="tittle">
            @if(empty($searched))
            <h2>All Auctions:</h2>
            @else
            <h2>Found Auctions:</h2>
            @endif
        </div>
    
        <div class="auctions">
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
        </div>
    </div>
</div>

<br>





@endsection