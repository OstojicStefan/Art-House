@extends('template_defined')

@section('content')

<!-- About us stranica sa informacijama o samom projektu -->

<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
<link rel="stylesheet" type="text/css" href="{{ asset('css/Exhibition.css') }}" >
<script src="{{asset('js/stefan/Exhibition.js')}}"></script>

<div class="row">
    <div class="col-sm-2">

    </div>
    <div class="col-sm-8">
        <p id="o-nama-cilj"><b>
            ArtHouse is a project created with the sole purpose of making Art more accesible. During the pandemic, many museums and galleries were forced to shut down depriving people from enjoying fine arts. We wanted to create a space for artists and regular folks in which they can share and view each others hard work. It doesn't matter if it's your painting or you bought it off someone else, ArtHouse is here to show off your exquisite collection!</b>
        </p>
    </div>
    <div class="col-sm-2">

    </div>
</div>

<div class="row">
    <div class="col-sm-12 col-md-4 o-nama-slike">
        <img src="slike/aboutus1.jpg" alt="">
    </div>
    <div class="col-sm-12 col-md-4 o-nama-slike">
        <img src="slike/aboutus2.jpg" alt="">      
    </div>
    <div class="col-sm-12 col-md-4 o-nama-slike">
        <img src="slike/aboutus3.jpg" alt="">
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <hr>
        <div id="mapa">
        <iframe id="frame" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2833.1520061540364!2d20.422515915749628!3d44.757314588350965!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x475a718f5da59243%3A0xf29c15241d765ca0!2sCentar%20Univerzuma!5e0!3m2!1sen!2srs!4v1624548679307!5m2!1sen!2srs" width="450" height="300" style="border:3px solid #ffc107" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <p id="kontakt">
            Telefon: +381605007000 <br>
            E-mail: <a href="mailto:arthouse@gmail.com">Arthouse@gmail.com</a>
        </p>
    </div>
</div>

@endsection