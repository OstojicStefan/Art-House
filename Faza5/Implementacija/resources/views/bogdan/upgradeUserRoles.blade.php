<!-- Bogdan Arsic 0329/19-->
<!-- Stranica za unapredjivanje korisnickih uloga-->
@extends('template_defined')

@section('content')
<script src = "{{url('js/bogdan/skriptaProveraTagova.js')}}"></script>
<div class="row">
                <div class="col-sm-12 center">
                    <form name = "unapredjivanjeUloga" action = "{{route('upgradeUserRolesSubmit')}}" method = "post" id ="unapredjivanjeUloga">
                        @csrf
                        <label id="usernameUKGreska"></label><br>
                        <label for="username">User to upgrade: </label><br>
                        <input type="text" maxlength="40" id="usernameUK" name="usernameUK"><br><br>
            
                        <label for="uloga">Role:</label><br>
                        <input type="radio" id="1UK" name="ulogaUK" checked value="Moderator">
                        <label>Moderator</label><br>
            
                        <input type="radio" id="2UK" name="ulogaUK" value = "Administrator">
                        <label>Administrator</label><br><br>
            
                        <input type = "submit" value = "Upgrade" onclick="proveriKorisnickoIme()">  </input>
                    </form>
                </div>
            </div>
@endsection
