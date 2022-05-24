@extends('template_defined')

@section('content')
<br>
<br>
<br>
<h1>{{ $exhibition->Name }}</h1>
@if( $exhibition->IsActive  == 't')
<p>Active</p>
dd{{ $exhibition }}
@else
<p>Expired</p>
dd{{ $exhibition }}
@endif
<br>
@foreach($images as $image)
    dd{{ $image }}
@endforeach
@endsection