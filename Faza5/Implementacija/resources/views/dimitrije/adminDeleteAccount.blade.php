<!-- Dimitrije Plavsic-->
@extends('template_defined')
<head>
    <title> Deleting user accounts </title>
</head>
@section('content')
<head>    
    <link rel="stylesheet" href="{{url('css/opste.css')}}">
    <script src="{{url('js/opste.js')}}"></script> 
</head>
<div class="row">
    <div class="col-sm-12 center">
        <form name = "adminUserDeletion" action = "{{route('adminDeleteAccountSubmit')}}" method = "post" id ="adminUserDeletion">
            @csrf
            <label id="usernameError"></label><br>
            <label for="username">User whose account you wish to delete: </label><br>
            <input type="text" maxlength="40" id="usernameInput" name="usernameInput"><br><br>

            <input type = "submit" value =" Delete account " onclick="checkUsername()" class = "button"></input><br><br>

            @if(session('status') == 'Account deletion successful!')
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