<!-- Bogdan Arsic 0329/19-->
<!-- Stranica za brisanje tagova sa sajta-->
@extends('template_defined')
<head>
    <title> Remove Tags </title>
</head>
@section('content')
<script src = "{{url('js/bogdan/skriptaProveraTagova.js')}}"></script>
<div class="row">
                <div class="col-sm-12 center">
                    <form name = "tagoviZaUklanjanje" action = "removeTags2" method = "post" id = "tagoviZaUklanjanje">
                        @csrf
                        <label id="RemoveTagsGreska"></label><br>
                        <label>Select the tags to be removed(ctrl+click): </label><br>
                        <select multiple="multiple" name="tagovi[]" id="tagovi" size = 15 id = "tagovi">
                            @foreach ($svitagovi as $tag)
                                <option value = "{{$tag->IDTag}}">{{$tag->Name}}</option>
                            @endforeach
                        </select><br><br>
                            <input type = "submit" value = "Delete tags">  </input><br>
                    </form>
                </div>
            </div>
@endsection
