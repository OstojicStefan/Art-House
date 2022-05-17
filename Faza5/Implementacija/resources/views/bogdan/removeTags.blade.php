<!-- Bogdan Arsic 0329/19-->
<!-- Stranica za brisanje tagova sa sajta-->
@extends('template_defined')

@section('content')
<div class="row">
                <div class="col-sm-12 center">
                    <form name = "tagoviZaUklanjanje" action = "removeTags2" method = "get">
                           @if(!empty($povratna)) 
                               <label style="color:blue;"> Uspeh! </label><br>
                            @endif
                        <label>Select the tags to be removed(ctrl+click): </label><br>
                        <select multiple="multiple" name="tagovi[]" id="tagovi" size = 15>
                            @foreach ($svitagovi as $tag)
                                <option value = "{{$tag->IDTag}}">{{$tag->Name}}</option>
                            @endforeach
                            </select><br><br>
                            <input type = "submit" value = "Delete tags">  </input><br>
                    </form>
                </div>
            </div>
@endsection
