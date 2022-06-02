@extends('template_defined')

@section('content')

<!-- Stranica sa osnovnim podacima o korisniku i odredjenim podesavanjima koje korisnik moze da sprovede -->

<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
<link rel="stylesheet" type="text/css" href="{{ asset('css/Exhibition.css') }}" >
<script src="{{asset('js/stefan/Exhibition.js')}}"></script>

<div class="row">
    <div id="myAccHeader" class="col-sm-12">
        <img id="profilePicture" src="{{asset('slike/profile_picture.jpg')}}" alt="" class="noHover">
        <h1>{{Session::get('Username')}}</h1>
    </div>
</div>

<div class="row">
    <div class="col-sm-3">

    </div>

    
    <div class="col-sm-6 personal-info">
        <a href="settings/deleteAccount"><p class="link-deactivate">Deactivate account</p></a>
        <hr>
        PERSONAL INFORMATION <br>
        <form action="{{route('settingsSubmit')}}" method="post" name="settingsSubmit">
            @csrf
         <table id="settings-table">
            <tr>
                <td>
                    <b>Username</b>
                </td>
                <td>
                    {{$user[0]->Username}}
                </td>
            </tr>

            <tr>
                <td>
                    <b>E-mail</b>
                </td>
                <td>
                    {{$user[0]->E_mail}}
                </td>
            </tr>

            <tr>
                <td>
                    <b>Balance</b>
                </td>
                <td>
                    {{$user[0]->Balance}}
                </td>
            </tr>

            <tr>
                <td>
                    <b>E-mail me about hot auctions</b>
                </td>
                <td>
                    <select name="hotAuctions" id="">
                        @if ($user[0]->FlagHotAuctions=='1')
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        @else
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        @endif
                    </select>
                </td>
            </tr>

            <tr>
                <td>
                    <b>E-mail me about ending auctions</b>
                </td>
                <td>
                    <select name="notifyEnding" id="">
                        @if ($user[0]->FlagNotifyEnding=='1')
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        @else
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        @endif
                    </select>
                </td>
            </tr>
        </table>
        <hr>
        <div style="text-align: center">
        <button class="btn btn-warning">Save changes</button>
        <input type="hidden" name="userID" value="{{$user[0]->IDUser}}">
        </div>
    </form>
    </div>
    

    <div class="col-sm-3">

    </div>
</div>

@endsection