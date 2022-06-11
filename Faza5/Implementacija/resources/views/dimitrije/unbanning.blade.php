<!-- Dimitrije Plavsic 18/0220-->
<!-- Stranica za unbanovanje naloga od strane moderatora-->
@extends('template_defined')
<head>
    <title> Unbanning user accounts </title>
</head>
@section('content')
<head>    
    <link rel="stylesheet" href="{{url('css/opste.css')}}">
    <script src="{{url('js/opste.js')}}"></script> 
</head>
<div class="row">
    <div class="col-sm-12 center">
        <form name = "userUnbanning" action = "{{route('unbanningSubmit')}}" method = "post" id ="useruUnbanning">
            @csrf
            <label id="usernameError"></label><br>
            <label for="username">User whose account you wish to unban: </label><br>
            <input type="text" maxlength="40" id="usernameInput" name="usernameInput"><br><br>

            <input type = "submit" value =" Unban account " onclick="checkUsername()" class = "button"></input><br><br>

            @if(session('status') == 'Account successfully unbanned!')
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