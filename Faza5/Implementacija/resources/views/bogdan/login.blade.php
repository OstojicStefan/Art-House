<!-- Bogdan Arsic-->
<html>
    <head>
        <link href="{{ url('css/opste.css')}}" rel="stylesheet" type = "text/css">
        <title>
            Login
        </title>

        <link href="{{  url('css/style.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>

    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <nav class="navbar navbar-expand-sm heder">
                        <a class="navbar-brand" href="../index.html">
                        <img src="{{ url('slike/logo.png')}}" alt="Logo" class="noHover">
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
     
                        <li class="nav-item dropdown">
                         <a href="" class="nav-link">
                             <div class="dropdown btn-warning">
                                 <button id="recepti_dugme" class="dropbtn btn-warning">Admin privileges</button>
                                 <div class="dropdown-content">
                                     <a href="unapredjivanjeKorisnickogNalogaGlavno.html">Upgrade roles</a>
                                     <a href="../dimitrije/ukidanjeModeratora.html">Downgrade roles</a>
                                     <a href="../dimitrije/banovanjeKorisnika.html">Ban user</a>
                                     <a href="../dimitrije/unbanovanjeKorisnika.html">Unban user</a>
                                     <a href="dodavanjeTagovaGlavno.html">Create tags</a>
                                     <a href="brisanjeTagovaGlavno.html">Remove tags</a>
                                     <a href="../dimitrije/brisanjeKorisnickihNaloga.html">Delete user accounts</a>
                                 </div>
                             </div>
                         </a>
                         </li>
     
                        </ul>
                       </nav>
                </div> 
            </div>
            @foreach ($tagovi as $tag)
                {{$tag->Name}}
            @endforeach
            <div class="row">
                <div class="col-sm-12 center">
                    <form>
                        <label for="username">Username: </label><br>
                        <input type="text" maxlength="40" id="username" name="username"><br><br>
            
                        <label for="password" >Password:</label><br>
                        <input type="password" maxlength="40" id="password" name="password"><br><br>
            
                        <a href="../myAccount.html" class="button">Log in</a><br>
                        
                        <a href = "registracija.html" > Register </label><br>
                        <a href = "../index.html" > Continue as guest </label>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
