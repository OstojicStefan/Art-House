<!-- Dimitrije Plavsic 18/0220-->
<!-- Stranica za dodavanje licitacija na aukcijama od strane registrovanih korisnika-->
@extends('template_defined')
<head>
    <title> Bidding </title>
</head>
@section('content')
<head>    
    <link rel="stylesheet" href="{{url('css/opste.css')}}">
    <script src="{{url('js/opste.js')}}"></script> 
</head>
<div class="row">
    <div class="col-sm-12 center">
        <form name = "biddingForm" action = "biddingSubmit" method = "post" id ="biddingForm">
            @csrf
            <!--<label id="bidError"></label><br> -->
            <label id="greska_ispis_2">How much would you like to bid on auction: {{ $auction->Name }} </label><br>
            <input type="number"  min="1" max="9999999999" id="bidInput" name="bidInput"><br><br>

            <input type = "submit" value =" Bid " class = "button"></input><br><br>

            @if(session('status') == 'Successfully placed bid.')
                <div class="alert alert-success">
                {{ session('status') }}
                </div>
            @else
                <font color = 'red' id="greska_ispis_1">{{session('status')}}</font><br>                
            @endif
        </form>
    </div>
</div>
@endsection