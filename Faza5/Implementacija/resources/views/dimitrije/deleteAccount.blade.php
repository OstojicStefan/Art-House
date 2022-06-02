<!-- Dimitrije Plavsic 18/0220-->
<!-- Stranica za brisanje sopstvenih naloga korisnika-->
@extends('template_defined')

<head>
    <title>Delete Account</title>
</head>

@section('content')
<head>    
    <link rel="stylesheet" href="{{url('css/opste.css')}}">
    <script src="{{url('js/opste.js')}}"></script> 
</head>
<body>
    <div class="row">
        <div class="col-sm-12 center">
            <form>
                <label> Are you sure you want to delete your account? This action cannot be undone!</label><br><br>
                <a href="{{ URL::route('deleteAccountSubmit'); }}" class="button"> Yes </a> &nbsp; &nbsp;
                <a href="{{ URL::route('auctions'); }}" class="button"> No </a><br><br>                                  <!--ovo promeni u myAccount kada stef doda-->
                
                @if(session('status'))
                <div class="alert alert-danger">
                {{ session('status') }}
                </div>
            @else
                <font color = 'red'>{{session('status')}}</font><br>                
            @endif

            </form>
        </div>   	
   </div>
</body>   
@endsection