<!-- Bogdan Arsic 0329/19-->
<!-- Stranica za login-ovanje korisnika-->
@extends('template_defined')

@section('content')
<div class="row">
    <div class="col-sm-12 center">
        <form name = "loginform" action = "{{route('loginSubmit')}}" method = post>
            @csrf
            @if(session('status'))
                <font color = 'red'> {{session('status')}}</font>
            @endif
            <label for="username">Username: </label><br>
                <input type="text" maxlength="40" id="username" name="username" value = "{{old('username')}}"><br>
                @error('username')
                    <td><font color = 'red'> {{$message}} </font>
                @enderror
                <br>
                <label for="password" >Password:</label><br>
                <input type="password" maxlength="40" id="password" name="password"><br>
                @error('password')
                    <td><font color = 'red'> {{$message}} </font>
                @enderror
                <br>

                <input type = "submit" value = "Log in" >  </input><br>
                        
                <a href = "registracija.html" > Register </label><br>
                <a href = "../index.html" > Continue as guest </label>
        </form>
    </div>
</div>
@endsection
