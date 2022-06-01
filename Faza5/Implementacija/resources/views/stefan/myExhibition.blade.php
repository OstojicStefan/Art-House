@extends('template_defined')

@section('content')

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
                        <option value="">no song</option>
                        <option value="">song 1</option>
                        <option value="">song 2</option>
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