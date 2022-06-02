@extends('template_defined')

@section('content')

<!-- Stranica gde korisnik finalizira svoju izlozbu dodatno opisujuci svaku sliku. Takodje bira se naziv, vreme, status donacija i potencijalno muzika na samoj izlozbi -->

<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
<link rel="stylesheet" type="text/css" href="{{ asset('css/opste.css') }}" >
<link rel="stylesheet" type="text/css" href="{{ asset('css/Exhibition.css') }}" >
<script src="{{asset('js/stefan/Exhibition.js')}}"></script>

    <div class="row">
        <div class="col-sm-12">
            <h1>Arrange your exhibition</h1>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">

        </div>
        <div class="col-sm-6">
            <form action="{{route('createExhibitionSubmit')}}" method="post" name="create_exhibition">
                @csrf
            <table id="tabela_uredjivanje">
                <tr>

                </tr>
            </table>
            <hr>
            
            <table id="tabela_finalno" class="table table-striped table-dark">
                <tr>
                    <td>
                        Exhibition name
                    </td>
                    <td>
                        <input id="naziv_izlozbe" type="text" name="exhibitionName">
                    </td>
                </tr>
                <tr>
                    <td>Allow donations for the duration of the exhibition </td>
                    <td><input type="checkbox" name="allowDonations"></td>
                </tr>
                <tr>
                    <td>Accompanying music</td>
                    <td><select value="" name="songChoice">
                        <option value="">no music</option>
                        <option value="https://www.youtube.com/embed/kLp_Hh6DKWc">Grieg - In the Hall of the Mountain King</option>
                        <option value="https://www.youtube.com/embed/GGU1P6lBW6Q">Richard Wagner - Ride of The Valkyries</option>
                        <option value="https://www.youtube.com/embed/GRxofEmo3HA">Vivaldi - Four Seasons</option>
                        <option value="https://www.youtube.com/embed/4Diu2N8TGKA">Offenbach - Can Can Music</option>
                        <option value="https://www.youtube.com/embed/B9zRToy-mwk">Tchaikovsky - Dance of the Sugar Plum Fairy</option>
                        <option value="https://www.youtube.com/embed/9E6b3swbnWg">Chopin - Nocturne op.9 No.2</option>
                        <option value="https://www.youtube.com/embed/XmttZ-BnwaI">Mozart - Requiem in D minor</option>
                    </select></td>
                </tr>
                <tr>
                    <td>Time of the exhibition</td>
                    <td><input id="vreme_izlozbe" type="datetime-local" name="exhibitionTime"></td>
                </tr>
                <tr class="centriraj">
                    <td colspan="2"><button class="btn btn-secondary" onclick="kreirajIzlozbu()">Done</button></td>
                </tr>
            </table>
            </form>
        </div>
        <div class="col-sm-3">
            
        </div>
    </div>

    <script>inicijalizujIzlozbu();</script>
@endsection