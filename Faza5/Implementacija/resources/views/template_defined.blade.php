@extends('template')

@section('header')
@if((Session::get('privilegije') == 'Administrator') || (Session::get('privilegije') == 'Moderator') || (Session::get('privilegije') == 'Obicni'))
            <div class="row">
                <div class="col-sm-12">
                    <nav class="navbar navbar-expand-sm heder">
                        <a class="navbar-brand" href="../index.html">
                        <img src="{{url('slike/logo.png')}}" alt="Logo" class="noHover">
                        </a>
                        <ul class="navbar-nav centriraj">
                        <li class="nav-item active">
                        <a class="nav-link" href="../index.html">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                        <a href="" class="nav-link">
                            <div class="dropdown btn-warning">
                                <button id="recepti_dugme" class="dropbtn btn-warning">Add Auction</button>
                                <div class="dropdown-content">
                                    <a href="pravljenjeAukcijeFizickeSlike.html">Physical</a>
                                    <a href="pravljenjeAukcijeVirtuelneSlike.html">Virtual</a>
                                </div>
                            </div>
                        </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="../nikola/nikola/pages/sve-aukcije.html">Auctions</a>
                        </li>
                        
                        <li class="nav-item">
                         <a class="nav-link" href="../createExhibition.html">Create Exhibition</a>
                        </li>
     
                        <li class="nav-item">
                            <a class="nav-link" href="../nikola/nikola/pages/sve-izlozbe.html">Exhibitions</a>
                        </li>
     
                        <li class="nav-item">
                            <a class="nav-link" href="../myAccount.html">My account</a>
                        </li>
     
                        <li class="nav-item">
                            <a class="nav-link" href="">About us</a>
                        </li>
                        
                        <div id="mojnalog" class="dropdown">
                            <button id="dugme_mojnalog" type="button" class="btn btn-primary
                           dropdown-toggle" data-bs-toggle="dropdown">
                            account
                            </button>
                            <div class="dropdown-menu">
                            <a class="dropdown-item" href="../myAccount.html">Profile</a>
                            <a class="dropdown-item" href="#">Settings</a>
                            <a class="dropdown-item" href="#">My auctions</a>
                            <div class="dropdown-divider"></div>
                            <a onclick="odjaviKorisnika()" class="dropdown-item" href="logovanje.html">Log out</a>
                            </div>
                        </div>
                        @if((Session::get('privilegije') == 'Administrator') || (Session::get('privilegije') == 'Moderator'))
                        <li class="nav-item dropdown">
                         <a href="" class="nav-link">
                             <div class="dropdown btn-warning">
                                 <button id="recepti_dugme" class="dropbtn btn-warning">Admin privileges</button>
                                 <div class="dropdown-content">
                                @if(Session::get('privilegije') == 'Administrator')
                                     <a href="unapredjivanjeKorisnickogNalogaGlavno.html">Upgrade roles</a>
                                     <a href="{{ URL::route('downgradeModerator'); }}">Downgrade roles</a>
                                     <a href="{{ URL::route('banning'); }}">Ban user</a>
                                     <a href="{{ URL::route('unbanning'); }}">Unban user</a>
                                     <a href="dodavanjeTagovaGlavno.html">Create tags</a>
                                     <a href="brisanjeTagovaGlavno.html">Remove tags</a>
                                     <a href="{{ URL::route('adminDeleteAccount'); }}">Delete user accounts</a>
                                 </div>
                                @endif
                             <!--</div> -->
                         </a>
                         </li>
                         @endif
     
                        </ul>
                       </nav>
                </div> 
            </div>
@endif

@if(empty(Session::get('privilegije')) || Session::get('privilegije')== 'gost')
<div class="row">
                <div class="col-sm-12">
                    <nav class="navbar navbar-expand-sm heder">
                        <a class="navbar-brand" href="../index.html">
                        <img src="{{url('slike/logo.png')}}" alt="Logo" class="noHover">
                        </a>
                        <ul class="navbar-nav centriraj">
                        <li class="nav-item active">
                        <a class="nav-link" href="../index.html">Home</a>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="../nikola/nikola/pages/sve-aukcije.html">Auctions</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="../nikola/nikola/pages/sve-izlozbe.html">Exhibitions</a>
                        </li>
     
                        <li class="nav-item">
                            <a class="nav-link" href="">About us</a>
                        </li>
                        </ul>
                       </nav>
                </div> 
            </div>
@endif
@endsection

@section('footer')
<hr>
<center style = "background-color:#ffc107;">Copyright 2020</center>
@endsection