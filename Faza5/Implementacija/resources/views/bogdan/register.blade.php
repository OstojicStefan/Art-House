<!-- Bogdan Arsic 0329/19-->
<!-- Stranica za registrovanje korisnika-->
@extends('template_defined')

@section('content')
<div class="row">
                <div class="col-sm-12 center">
                    <form action="nekaStrana.html">   <!-- koja ce stranica da se otvori-->

                        <label for="username">Username: </label><br>
                        <input type="text" maxlength="40" id="username" name="username"><br><br>
            
                        <label for="password" >Password:</label><br>
                        <input type="password" maxlength="40" id="password" name="password"><br><br>
            
                        <label for="password2">Repeat password: </label><br>
                        <input type="password" maxlength="40" id="password2" name="password2"><br><br>
            
                        <label for="email">E-mail: </label> <br>
                        <input type="text" maxlength="40" id="email" name="email"><br><br>
            
                        <label for="brojKartice">Card numeber: </label> <br>
                        <input type="number" maxlength="16" id="brojKartice" name="brojKartice"><br><br>
            
                        <label for="ccvKartice">CCV: </label> <br>
                        <input type="password" maxlength="3" id="ccvKartice" name="ccvKartice"><br><br>
            
                        <label for="iznos">Amount to be transferred(optional): </label> <br>
                        <input type="text" maxlength="3" id="iznos" name="iznos"><br><br>
            
                        <input type="checkbox" maxlength="3" id="zelimHotAukcijeNaMail" name="zelimHotAukcijeNaMail">
                        <label for="zelimHotAukcijeNaMail">Send me hot auctions via e-mail. </label><br><br>
            
                        <input type="checkbox" maxlength="3" id="obavestMeOKrajuAukcije" name="obavestMeOKrajuAukcije">
                        <label for="obavestMeOKrajuAukcije">Notify me about the end of auctions I participated in via e-mail.  </label><br><br>
            
                        <a href="registracijaSporedno1.html" class="button">Sign up</a><br>
                    </form>
                </div>
            </div>
@endsection
