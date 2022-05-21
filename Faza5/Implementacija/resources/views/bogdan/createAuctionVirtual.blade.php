<!-- Bogdan Arsic 0329/19-->
<!-- Stranica za kreiranje aukcije virtuelne slike-->
@extends('template_defined')

@section('content')
<script src = "{{url('js/bogdan/skriptaProveraTagova.js')}}"></script>
<div class="row">
                <div class="col-sm-12 center">
                <form name = "addvirtualauction" action = "{{route('createAuctionVirtualSubmit')}}" method = "post" id = "addvirtualauction" enctype="multipart/form-data">
                    @csrf
                        <label for="imeSlike">Image name: </label><br>
                        <input type="text" maxlength="30" id="imeSlike" name="imeSlike"><br><br>
            
                        <label for="opisniTekst">Short description: </label><br>
                        <textarea rows = "12" cols = "30" maxlength="5000" id="opisniTekst" name="opisniTekst"></textarea><br><br>
            
                        <label for="Autor">Author: </label><br>
                        <input type="text" maxlength="30" id="Autor" name="Autor"><br><br>
            
                        <label for="godinaSlikanja">Year of creation: </label><br>
                        <input type="number" max="30" id="godinaSlikanja" name="godinaSlikanja"><br><br>
            
                        <label for="myfile">Choose image:</label>
                        <input type="file" id="myfile" name="myfile" /><br><br>
            
                        <label>Tags(1-5): </label><br>
                        <select name="predmeti"  multiple = 5>
                            @foreach ($svitagovi as $tag)
                                <option value = "{{$tag->IDTag}}">{{$tag->Name}}</option>
                            @endforeach
                            </select><br><br>
            
                            <label for="pocetnaCena">Starting price on auction(din): </label><br>
                            <input type="number" maxlength="30" id="pocetnaCena" name="pocetnaCena"><br><br>
                
                            <label for="vremeTrajanja">Austion duration(1-30 days): </label><br>
                            <input type="number" maxlength="30" id="vremeTrajanja" name="vremeTrajanja"><br><br>

                            <input type = "submit" value = "Create auction" onclick= "createAuctionProvera()">  </input><br>
                    </form>
                </div>
            </div>
@endsection
