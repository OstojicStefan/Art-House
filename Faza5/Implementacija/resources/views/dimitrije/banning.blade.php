<!-- Dimitrije Plavsic 18/0220-->
<!-- Stranica za banovanje naloga od strane moderatora-->
@extends('template_defined')
<head>
    <title> Banning user accounts </title>
</head>
@section('content')
<head>    
    <link rel="stylesheet" href="{{url('css/opste.css')}}">
    <script src="{{url('js/opste.js')}}"></script> 
</head>
<div class="row">
    <div class="col-sm-12 center">
        <form name = "userBanning" action = "{{route('banningSubmit')}}" method = "post" id ="userBanning">
            @csrf
            <label id="usernameError"></label><br>
            <label for="username">User whose account you wish to ban: </label><br>
            <input type="text" maxlength="40" id="usernameInput" name="usernameInput"><br><br>

            <input type = "submit" value =" Ban account " onclick="checkUsername()" class = "button"></input><br><br>

            @if(session('status') == 'Account successfully banned!')
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