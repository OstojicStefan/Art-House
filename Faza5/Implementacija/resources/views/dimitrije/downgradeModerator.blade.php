<!-- Dimitrije Plavsic 18/0220-->
<!-- Stranica za ukidanje uloga moderatora od strane admina-->
@extends('template_defined')
<head>
    <title> Downgrading moderator </title>
</head>
@section('content')
<head>    
    <link rel="stylesheet" href="{{url('css/opste.css')}}">
    <script src="{{url('js/opste.js')}}"></script> 
</head>
<div class="row">
    <div class="col-sm-12 center">
        <form name = "modDowngrade" action = "{{route('downgradeModeratorSubmit')}}" method = "post" id ="modDowngrade">
            @csrf
            <label id="usernameError"></label><br>
            <label for="username">Moderator you wish to downgrade to a regular user: </label><br>
            <input type="text" maxlength="40" id="usernameInput" name="usernameInput"><br><br>

            <input type = "submit" value =" Downgrade " onclick="checkUsername()" class="button"></input><br><br>

            @if(session('status') == 'Account successfully downgraded!')
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