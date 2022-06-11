<!-- Bogdan Arsic 0329/19-->
<!-- Stranica za registrovanje korisnika-->
@extends('template_defined')
<head>
    <title> Register </title>
</head>
@section('content')
<script src = "{{url('js/bogdan/skriptaProveraTagova.js')}}"></script>
<div class="row">
                <div class="col-sm-12 center">
                <div id = "formaRegistrovanje">
                <form name = "registerform" action = "{{route('registerSubmit')}}" method = "post" id = "registerform">   <!-- koja ce stranica da se otvori-->
                @csrf
                        <label for="username">Username: </label><br>
                        <input type="text" maxlength="40" id="username" name="username"><br>
                        <label id="usernameGreskaRegistracija"></label><br>
            
                        <label for="password" >Password:</label><br>
                        <input type="password" maxlength="40" id="password" name="password"><br>
                        <label id="passwordGreskaRegistracija"></label><br>
            
                        <label for="password2">Repeat password: </label><br>
                        <input type="password" maxlength="40" id="password2" name="password2"><br>
                        <label id="password2GreskaRegistracija"></label><br>
            
                        <label for="email">E-mail: </label> <br>
                        <input type="text" maxlength="40" id="email" name="email"><br>
                        <label id="emailGreskaRegistracija"></label><br>
            
                        <label for="brojKartice">Card number: </label> <br>
                        <input type="number" maxlength="9" id="brojKartice" name="brojKartice"><br>
                        <label id="brojKarticeGreskaRegistracija"></label><br>
            
                        <label for="ccvKartice">CCV: </label> <br>
                        <input type="password" maxlength="3" id="ccvKartice" name="ccvKartice"><br>
                        <label id="ccvKarticeGreskaRegistracija"></label><br>
            
                        <label for="iznos">Amount to be transferred(din)(optional): </label> <br>
                        <input type="text" maxlength="3" id="iznos" name="iznos" value = "0"><br>
                        <label id="iznosGreskaRegistracija"></label><br>
            
                        <input type="checkbox" maxlength="3" id="zelimHotAukcijeNaMail" name="zelimHotAukcijeNaMail">
                        <label for="zelimHotAukcijeNaMail">Send me hot auctions via e-mail. </label><br>
            
                        <input type="checkbox" maxlength="3" id="obavestMeOKrajuAukcije" name="obavestMeOKrajuAukcije">
                        <label for="obavestMeOKrajuAukcije">Notify me about the end of auctions I participated in via e-mail.  </label><br>
            
                        <input type = "submit" value = "Sign up" onclick="registracijaProvera()">  </input><br>
                        <label id="GreskaUopste"></label><br>
                    </form>
                </div>
                <div id = "formaRegistrovanjeGotovo">
                <form name = "loginJump" action = "{{route('login')}}" method = "get" id = "loginJump">   <!-- koja ce stranica da se otvori-->
                    <label id="PovratnaUspeh"></label><br>
                        <input type = "submit" value = "Log in">  </input>
                    </form>
                </div>
        </div>
</div>
@endsection
