<!-- Bogdan Arsic 0329/19-->
<!-- Stranica za dodavanje novih tagova-->
@extends('template_defined')

@section('content')
@foreach ($slike as $slika)
{{$slika->Imagee}} <img src = "{{asset('storage/images/'.$slika->Imagee)}}">
@endforeach
@endsection
