<!-- Bogdan Arsic 0329/19-->
<!-- Stranica za dodavanje novih tagova-->
@extends('template_defined')

@section('content')
<div class="row">
                <div class="col-sm-12 center">
                    <form name = "tagZaDodavanje" action = "addTagsSubmit" method = "get">
                        <label for="imeTaga">Enter new tag: </label><br>
                        <input type="text" maxlength="40" id="imeTaga" name="imeTaga"><br><br>
                            
                        <input type = "submit" value = "Add tag">  </input><br>
                        <!--<a href="dodavanjeTagovaSporedno1.html" class="button">Add tag</a><br>-->
                    </form>
                </div>
            </div>
@endsection
