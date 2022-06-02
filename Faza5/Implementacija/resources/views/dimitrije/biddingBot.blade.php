<!-- Dimitrije Plavsic 18/0220-->
<!-- Stranica za dodavanje bota na aukciji od strane korisnika-->
@extends('template_defined')
<head>
    <title> Bidding bot </title>
</head>
@section('content')
<head>    
    <link rel="stylesheet" href="{{url('css/opste.css')}}">
    <script src="{{url('js/opste.js')}}"></script> 
</head>
<div class="row">
    <div class="col-sm-12 center">
        <form name = "biddingBotForm" action = "biddingBotSetup" method = "post" id ="biddingBotForm">
            @csrf
            <!--<label id="bidError"></label><br> -->
            <label>What is the maximum amout you want your bot to bid on auction: {{ $auction->Name }} </label><br>
            <input type="number"  min="1" max="9999999999" id="bidBotInput" name="bidBotInput"><br><br>

            <input type = "submit" value =" Bid Bot " class = "button"></input><br><br>

            @if(session('status') == 'Successfully set up bot on auction.')
                <div class="alert alert-success">
                {{ session('status') }}
                </div>
            @else
                <font color = 'red'>{{session('status')}}</font><br>                
            @endif
        </form>
    </div>
</div>
@endsection