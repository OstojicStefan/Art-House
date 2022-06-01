@extends('template_defined')

@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
<link rel="stylesheet" type="text/css" href="{{ asset('css/Exhibition.css') }}" >
<script src="{{asset('js/stefan/Exhibition.js')}}"></script>

<div class="row">
    <div id="index_logo" class="col-sm-12">
        <img src="{{asset('slike/art_house.png')}}" alt="" class="noHover">
    </div>
</div>

@if(empty(Session::get('privilegije')) || Session::get('privilegije')== 'gost')
<div class="row">
    <div id="index_login" class="col-sm-12 centerEx">
        <button onclick="location.href='/login'" id="index_login_dugme" class="btn btn-warning">Login</button>
    </div>
</div>
@endif

@if((Session::get('privilegije') == 'Administrator') || (Session::get('privilegije') == 'Moderator') || (Session::get('privilegije') == 'Obicni'))

<div class="row">
    <div class="col-sm-12 najnovije-izlozbe-header">
        Most recent exhibitions...
    </div>
</div>

<div class="row">
    <div id="exhibition-1" class="col-12 col-lg-3 najnoviji-recepti index-banner zoom">
    <a href="/exhibition/{{$mostRecent[0]->IDExh}}">
    {{$mostRecent[0]->Name}} <br><img src="data:image/jpg;base64,{{ chunk_split($mostRecentImages[0]->Imagee) }}" class="noHover img-fluid image-index"></a> 
    </div>

    <div id="exhibition-2" class="col-12 col-lg-3 najnoviji-recepti index-banner zoom">
    <a href="/exhibition/{{$mostRecent[1]->IDExh}}">
    {{$mostRecent[1]->Name}} <br><img src="data:image/jpg;base64,{{ chunk_split($mostRecentImages[1]->Imagee) }}" class="noHover img-fluid image-index"></a>
    </div>

    <div id="exhibition-3" class="col-12 col-lg-3 najnoviji-recepti index-banner zoom">
    <a href="/exhibition/{{$mostRecent[2]->IDExh}}">{{$mostRecent[2]->Name}} <br><img src="data:image/jpg;base64,{{ chunk_split($mostRecentImages[2]->Imagee) }}" class="noHover img-fluid image-index"></a>
    </div>

    <div id="exhibition-4" class="col-12 col-lg-3 najnoviji-recepti index-banner zoom">
    <a href="/exhibition/{{$mostRecent[3]->IDExh}}">
    {{$mostRecent[3]->Name}} <br><img src="data:image/jpg;base64,{{ chunk_split($mostRecentImages[3]->Imagee) }}" class="noHover img-fluid image-index"></a>
    </div>
</div>






<div class="row">
    <div class="col-sm-12 najnovije-izlozbe-header">
        Most recent auctions...
    </div>
</div>

<div class="row">
    <div id="auction-1" class="col-12 col-lg-3 najnoviji-recepti index-banner zoom">
    <a href="/auction/{{$mostRecentAuctions[0]->IDAuc}}">
    {{$mostRecentAuctions[0]->Name}} &nbsp;&nbsp;&nbsp; Price:  {{$mostRecentAuctions[0]->Price}}<br><img src="data:image/jpg;base64,{{ chunk_split($images->findImage($mostRecentAuctions[0]->IDIm)->Imagee) }}" class="noHover img-fluid image-index"></a><br> 
    </div>

    <div id="auction-2" class="col-12 col-lg-3 najnoviji-recepti index-banner zoom">
    <a href="/auction/{{$mostRecentAuctions[1]->IDAuc}}">
    {{$mostRecentAuctions[1]->Name}} &nbsp;&nbsp;&nbsp; Price:  {{$mostRecentAuctions[1]->Price}}<br><img src="data:image/jpg;base64,{{ chunk_split($images->findImage($mostRecentAuctions[1]->IDIm)->Imagee) }}" class="noHover img-fluid image-index"></a>
    </div>

    <div id="auction-3" class="col-12 col-lg-3 najnoviji-recepti index-banner zoom">
    <a href="/auction/{{$mostRecentAuctions[2]->IDAuc}}">{{$mostRecentAuctions[2]->Name}} &nbsp;&nbsp;&nbsp; Price:  {{$mostRecentAuctions[2]->Price}}<br><img src="data:image/jpg;base64,{{ chunk_split($images->findImage($mostRecentAuctions[2]->IDIm)->Imagee) }}" class="noHover img-fluid image-index"></a>
    </div>

    <div id="auction-4" class="col-12 col-lg-3 najnoviji-recepti index-banner zoom">
    <a href="/auction/{{$mostRecentAuctions[3]->IDAuc}}">
    {{$mostRecentAuctions[3]->Name}} &nbsp;&nbsp;&nbsp; Price:  {{$mostRecentAuctions[3]->Price}}<br><img src="data:image/jpg;base64,{{ chunk_split($images->findImage($mostRecentAuctions[3]->IDIm)->Imagee) }}" class="noHover img-fluid image-index"></a>
    </div>
</div>

@endif

<div class="row">
    <div class="col-sm-12">
        &nbsp;
    </div>
</div>

@endsection