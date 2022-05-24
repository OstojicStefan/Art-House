@extends('template_defined')

@section('content')
<br>
<br>
<br>
<h1>{{ $auction->Name }}</h1>
<h2>{{ $auction->Author }}</h2>
<p> {{ $auction->Description }}</p>
<p> {{ $tag }} </p>
<p>Owner: {{ $owner }}</p>
<p>Image path: {{ $image }}</p>
@if( $auction->IsActive  == 't')
<p>Active</p>
dd{{ $auction }}
@else
<p>Expired</p>
dd{{ $auction }}
@endif
<br>
<img src="data:image/jpg;base64,{{ chunk_split($image->Imagee) }}">
@endsection