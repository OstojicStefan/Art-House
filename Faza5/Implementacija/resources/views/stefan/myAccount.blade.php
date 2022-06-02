@extends('template_defined')

@section('content')

<!-- Stranica personalizovana sa korisnikovim podacima i najbitnijim informacijama -->

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
    <div class="col-sm-6">
        <div class="personal-info">
        <a href="deposit_money" class="link-deactivate">Deposit money</a></div> <hr>
        
        <table id="myAuctions" class="table table-striped table-warning">
            <tr>
                <th>My Auctions</th>
                <th>S/B</th>
            </tr>
            @foreach ($auctions as $auction)
            <tr>
                <td>
                    <a href="../auction/{{$auction->IDAuc}}">{{$auction->Name}}</a>
                </td>
                <td>
                    @if (Session::get('IDUser')==$auction->Owner)
                    Seller
                    @else
                    Buyer
                    @endif
                </td>
            </tr>
            @endforeach
        </table>
        <hr>
        <h3>My pictures...</h3>
    </div>
    <div class="col-sm-3">

    </div>
</div>
<div id="myPictures" class="row">
    <div class="col-sm-3">

    </div>
    
    <div class="col-sm-6">
        <table class="table centerEx">
            @foreach ($images->chunk(3) as $row )
            <tr>
                @foreach ($row as $image)
                <td><div class="zoom">
                    <img src="data:image/jpg;base64,{{ chunk_split($image->Imagee) }}" class="img-fluid">
                        <p>
                    
                        </p>
                    </div>
                </td> 
                @endforeach
            </tr>
            @endforeach
        </table>
    </div>

     <div class="col-sm-3">

    </div>
</div>
@endsection