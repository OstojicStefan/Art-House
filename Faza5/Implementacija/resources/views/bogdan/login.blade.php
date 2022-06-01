<!-- Bogdan Arsic 0329/19-->
<!-- Stranica za loginovanje korisnika-->
@extends('template_defined')

@section('content')
<script src = "{{url('js/bogdan/skriptaProveraTagova.js')}}"></script>
<div class="row">
    <div class="col-sm-12 center">
        <form name = "loginform" action = "{{route('loginSubmit')}}" method = "post" id = "loginform">
            @csrf
            @if(session('status'))
                <font color = 'red'> {{session('status')}}</font><br>
            @endif
            @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
            <label for="username">Username: </label><br>
                <input type="text" maxlength="40" id="username" name="username" value = "{{old('username')}}"><br>
                @error('username')
                    <td><font color = 'red'> {{$message}} </font>
                @enderror
                <label id="usernameGreskaLogin"></label><br>
                <br>
                <label for="password" >Password:</label><br>
                <input type="password" maxlength="40" id="password" name="password"><br>
                @error('password')
                    <td><font color = 'red'> {{$message}} </font>
                @enderror
                <label id="passwordGreskaLogin"></label><br>
                <br>
                <input type = "submit" value = "Log in" onclick="proveriPasswordiUsername()">  </input><br>
                        

                <a href = "register" > Register </label><br>
                <a href = "auctions" > Continue as guest </label>
                @if(session('status') == 'Account deletion successful!')
                    <div class="alert alert-success">
                    {{ session('status') }}
                    </div>
                @endif    

        </form>
    </div>
</div>
@endsection
