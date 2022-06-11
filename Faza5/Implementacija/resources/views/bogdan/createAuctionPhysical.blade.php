<!-- Bogdan Arsic 0329/19-->
<!-- Stranica za kreiranje aukcije fizicke slike-->
@extends('template_defined')
<head>
    <title> Create Auction </title>
</head>
@section('content')
<script src = "{{url('js/bogdan/skriptaProveraTagova.js')}}"></script>
<div class="row">
                <div class="col-sm-12 center">
                <form name = "addphysicalauction" action = "{{route('createAuctionSubmit')}}" method = "post" id = "addphysicalauction" enctype="multipart/form-data">
                    @csrf
                    @if(session('status') == 'Success!')
                    <font color = 'blue'>{{session('status')}}</font><br>
                    @else
                    <font color = 'red'>{{session('status')}}</font><br>
                    @endif
                        <input type="hidden" id="PhysicalVirtual" name="PhysicalVirtual" value="physical">
                        <label for="imeSlike">Image name: </label><br>
                        <input type="text" maxlength="30" id="imeSlike" name="imeSlike"><br>
                        <label id="imeSlikeGreska"></label><br>
            
                        <label for="opisniTekst">Short description: </label><br>
                        <textarea rows = "12" cols = "30" maxlength="5000" id="opisniTekst" name="opisniTekst"></textarea><br>
                        <label id="opisniTekstGreska"></label><br>

                        <label for="Autor">Author: </label><br>
                        <input type="text" maxlength="30" id="Autor" name="Autor"><br>
                        <label id="AutorGreska"></label><br>
            
                        <label for="godinaSlikanja">Year of creation: </label><br>
                        <input type="number" id="godinaSlikanja" name="godinaSlikanja"><br>
                        <label id="godinaSlikanjaGreska"></label><br>

                        <label for="lokacijaSlike">Location: </label><br>
                        <input type="text" max="30" id="lokacijaSlike" name="lokacijaSlike"><br>
                        <label id="lokacijaSlikeGreska"></label><br>
            
                        <label for="myfile">Choose image:</label>
                        <input type="file" id="myfile" name="myfile" accept=".jpg,.png"/><br>
                        <label id="myfileGreska"></label><br>
            
                        <label>Tags(1-5): </label><br>
                        <select name="tagoviCA[]"  multiple id = "tagoviCA">
                            @foreach ($svitagovi as $tag)
                                <option value = "{{$tag->IDTag}}" class = "tagKlasa">{{$tag->Name}}</option>
                            @endforeach
                            </select><br>
                            <label id="tagoviCAGreska"></label><br>
            
                            <label for="pocetnaCena">Starting price on auction(din): </label><br>
                            <input type="number" maxlength="13" id="pocetnaCena" name="pocetnaCena" step=".001"><br>
                            <label id="pocetnaCenaGreska"></label><br>
                
                            <label for="vremeTrajanja">Auction duration(1-30 days): </label><br>
                            <input type="number" maxlength="30" id="vremeTrajanja" name="vremeTrajanja"><br>
                            <label id="vremeTrajanjaGreska"></label><br>

                            <input type = "submit" value = "Create auction" onclick="createAuctionProvera()">  </input><br>
                    </form>
                </div>
            </div>
@endsection
