<!-- Bogdan Arsic 0329/19-->
<!-- Stranica za dodavanje novih tagova-->
@extends('template_defined')

@section('content')
@foreach ($slike as $slika)
<img src="data:image/jpg;base64,{{ chunk_split($slika->Imagee) }}">
@endforeach
@endsection
