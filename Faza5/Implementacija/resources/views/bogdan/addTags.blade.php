<!-- Bogdan Arsic 0329/19-->
<!-- Stranica za dodavanje novih tagova-->
@extends('template_defined')
<head>
    <title> Add Tags </title>
</head>
@section('content')
<script src = "{{url('js/bogdan/skriptaProveraTagova.js')}}"></script>
<div class="row">
                <div class="col-sm-12 center">
                    <form name = "tagZaDodavanje" action = "addTagsSubmit" method = "post" id = "tagZaDodavanje">
                    @csrf
                    @if(!empty($povratna)) 
                    @if($povratna == 1)
                    <label style="color:blue;"> Success! </label>
                    @endif
                    @endif
                        <label id="imeTagaGreska"></label><br>
                        <label for="imeTaga">Enter new tag: </label><br>
                        <input type="text" maxlength="40" id="imeTaga" name="imeTaga"><br><br>
                            
                        <input type = "submit" value = "Add tag" onclick = "proveriTag()">  </input><br>
                        <!--<a href="dodavanjeTagovaSporedno1.html" class="button">Add tag</a><br>-->
                    </form>
                </div>
            </div>
@endsection
