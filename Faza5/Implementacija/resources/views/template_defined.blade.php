@extends('template')

@section('header')
@if((Session::get('privilegije') == 'Administrator') || (Session::get('privilegije') == 'Moderator') || (Session::get('privilegije') == 'Obicni'))
            <div class="row">
                <div class="col-sm-12">
                    <nav class="navbar navbar-expand-sm heder">
                        <a class="navbar-brand" href="/">
                        <img src="{{url('slike/logo.png')}}" alt="Logo" class="noHover">
                        </a>
                        <ul class="navbar-nav centriraj">
                        <li class="nav-item active">
                        <a class="nav-link" href="/">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                        <a href="" class="nav-link">
                            <div class="dropdown btn-warning">
                                <button id="recepti_dugme" class="dropbtn btn-warning">Add Auction</button>
                                <div class="dropdown-content">
                                    <a href="{{ URL::route('createAuctionPhysical'); }}">Physical</a>
                                    <a href="{{ URL::route('createAuctionVirtual'); }}">Virtual</a>
                                </div>
                            </div>
                        </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="{{ URL::route('auctions'); }}">Auctions</a>
                        </li>                        
                        <li class="nav-item">
                         <a class="nav-link" href="{{ URL::route('createExhibition'); }}">Create Exhibition</a>
                        </li>     
                        <li class="nav-item">
                            <a class="nav-link" href="{{ URL::route('exhibitions'); }}">Exhibitions</a>
                        </li>     
                        <li class="nav-item">
                            <a class="nav-link" href="{{ URL::route('myAccount'); }}">My account</a>
                        </li>     
                        <li class="nav-item">
                            <a class="nav-link" href="{{ URL::route('aboutUs'); }}">About us</a>
                        </li>
                        
                        <div id="mojnalog" class="dropdown">
                            <button id="dugme_mojnalog" type="button" class="btn btn-primary
                           dropdown-toggle" data-bs-toggle="dropdown">
                            {{Session::get('Username')}}
                            </button>
                            <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ URL::route('myAccount'); }}">Profile</a>
                            <a class="dropdown-item" href="{{ URL::route('settings'); }}">Settings</a>
                            <a class="dropdown-item" href="{{ URL::route('myAccount'); }}">My auctions</a>

                            <div class="dropdown-divider"></div>
                            <a onclick="odjaviKorisnika()" class="dropdown-item" href="{{ URL::route('logout'); }}">Log out</a>
                            </div>
                        </div>
                        @if((Session::get('privilegije') == 'Administrator') || (Session::get('privilegije') == 'Moderator'))
                        <li class="nav-item dropdown">
                         <a href="" class="nav-link">
                             <div class="dropdown btn-warning">
                                 <button id="recepti_dugme" class="dropbtn btn-warning">Admin privileges</button>
                                 <div class="dropdown-content">
                                 <a href="{{ URL::route('banning'); }}">Ban user</a>
                                 <a href="{{ URL::route('unbanning'); }}">Unban user</a>
                                 <a href="{{ URL::route('addTags'); }}">Create tags</a>
                                 <a href="{{ URL::route('removeTags'); }}">Remove tags</a> 
                                 <a href="{{ URL::route('upgradeUserRoles'); }}">Upgrade roles</a>
                                @if(Session::get('privilegije') == 'Administrator')
                                     <a href="{{ URL::route('downgradeModerator'); }}">Downgrade roles</a>                                     
                                     <a href="{{ URL::route('adminDeleteAccount'); }}">Delete user accounts</a>
                                 </div>
                                @endif
                             </div>
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
                        <a class="navbar-brand" href="/">
                        <img src="{{url('slike/logo.png')}}" alt="Logo" class="noHover">
                        </a>
                        <ul class="navbar-nav centriraj">
                        <li class="nav-item active">
                        <a class="nav-link" href="/">Home</a>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="{{ URL::route('auctions'); }}">Auctions</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="{{ URL::route('exhibitions'); }}">Exhibitions</a>
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

<footer id="footer">
    <div class="row">
        <div class="col-sm-12 footer">
            <i>Copyright 2022, Nikola Gušić, Bogdan Arsić, Dimitrije Plavšić i Stefan Ostojić, Odsek za softversko inženjerstvo Elektrotehničkog fakulteta Univerziteta u Beogradu</i>
        </div>
    </div>
</footer>

@endsection