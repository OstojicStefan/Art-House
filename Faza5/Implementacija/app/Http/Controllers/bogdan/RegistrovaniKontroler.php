<?php
// Bogdan Arsic 329/19
// kontroler koji pokriva funkcionalnost registrovanog korisnika
namespace App\Http\Controllers\bogdan;

use App\Http\Controllers\Controller;
use App\Models\bogdan\SviTagovi;
use App\Models\bogdan\SviKorisnici;
use App\Models\bogdan\SviTagoviWithImage;
use App\Models\bogdan\SviAdministratori;
use App\Models\bogdan\SveAukcije;
use App\Models\bogdan\SveVirtuelne;
use App\Models\bogdan\SveFizicke;
use App\Models\bogdan\SviModeratori;
use App\Models\bogdan\SveSlike;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Session\Session;


class RegistrovaniKontroler extends Controller
{
    // dodavanje taga
    public function addTags(){
        return view('bogdan/addTags');
    }

    // submit dugme za dodavanje taga
    public function addTagsSubmit(Request $request){
        $regex = '/^\w{3,40}$/';
        $povratna = "<div style = 'color:red'>Tag is not in right format!</div>";
        if(!empty($request['imeTaga'])){
            $svi = SviTagovi::all();
            foreach ($svi as $jedan) {
                if($jedan['Name'] == $request['imeTaga']){
                    $povratna = "<div style = 'color:red'>Tag already exists!</div>";
                    return response()->json(['status'=>1, 'msg'=>$povratna]);
                }
            }
            if(preg_match($regex, $request['imeTaga'])){
                $novi = new SviTagovi;
                $novi->Name = $request['imeTaga'];
                $novi->save();
                $povratna = "<div style = 'color:blue'>Tag successfully adeed!</div>";
            }
        }
        

        return response()->json(['status'=>1, 'msg'=>$povratna]);
    }

    // uklanjanje tagova
    public function removeTags(){
        $svitagovi = SviTagovi::all();

        return view('bogdan/removeTags', ['svitagovi' => $svitagovi]);
    }

    // dodavanje aukcije virtuelne slike
    public function createAuctionVirtual(){
        $svitagovi = SviTagovi::all();

        return view('bogdan/createAuctionVirtual', ['svitagovi' => $svitagovi]);
    }

    // submit dugme na stranici dodavanja aukcije virtuelne slike
    public function createAuctionSubmit(Request $request){

    //dd($request->file());
/*
        $size = $request->file('myfile')->getSize();
        $name = uniqid(). '.'.  $request->file('myfile')->getClientOriginalExtension();

        $request->file('myfile')->storeAs('public/images/', $name);

        $novi = new SveSlike();
        $novi->IDUser = '1';
        $novi->Imagee = $name;
        $novi->IsPhysical = '1';
        $novi->save();
*/
        //ubacivanje u Image:
        $novi = new SveSlike();
        $path = $request->file('myfile')->getRealPath();
        $logo = file_get_contents($path);
        $base64 = base64_encode($logo);
        $novi->Imagee = $base64;
        if($request['PhysicalVirtual'] == 'virtual'){
            $novi->IsPhysical = '0';
        }else{
            $novi->IsPhysical = '1';
        }
        $novi->IDUser = $request->session()->get('IDUser');
        $novi->save();

        // ubacivanje u ImageWithTags
        $idSlike =  $novi->IDIm;
        $tagovi = $request->input('tagoviCA');
        if(!empty($tagovi)){
            $broj = 0;
            foreach ($tagovi as $tag){
                $jedan = SviTagovi::find($tag);
                if(!empty($jedan)){
                   $ivt = new SviTagoviWithImage();
                   $ivt->IDIm = $idSlike;
                   $ivt->IDTag = $jedan->IDTag;
                   $ivt->save();
                   if(++$broj == 5) break;
                }
            }
        }

        //ubacivanje u Auction
        $vremeTrajanja = $request['vremeTrajanja'];
        $pocetnaCena = $request['pocetnaCena'];
        $godinaSlikanja = $request['godinaSlikanja'];
        $Autor = $request['Autor'];
        $opisniTekst = $request['opisniTekst'];
        $imeSlike = $request['imeSlike'];

        $novaAukcija = new SveAukcije();
        $novaAukcija->Name = $imeSlike;
        $novaAukcija->Description = $opisniTekst;
        $novaAukcija->Author = $Autor;
        $novaAukcija->Year = $godinaSlikanja;
        $novaAukcija->IDIm = $idSlike;
        $novaAukcija->Price = $pocetnaCena;
        $novaAukcija->Duration = $vremeTrajanja;
        $novaAukcija->IsActive = '1';
        $novaAukcija->Owner = $request->session()->get('IDUser');
        $novaAukcija->ViewCount = '0';
        $novaAukcija->save();

        $IDAucNew = $novaAukcija->IDAuc;
        //ubacivanje u Virtuall ili Physucal
        if($request['PhysicalVirtual'] == 'virtual'){
            $novaVirt = new SveVirtuelne();
            $novaVirt->IDAuc = $IDAucNew;
            $novaVirt->save();
        }else{
            $novaFiz = new SveFizicke();
            $novaFiz->IDAuc = $IDAucNew;
            $novaFiz->Location = $request['lokacijaSlike'];
            $novaFiz->save();
        }


        return redirect()->back();
    }

    // dodavanje aukcije fizicke slike
    public function createAuctionPhysical(){
        $svitagovi = SviTagovi::all();

        return view('bogdan/createAuctionPhysical', ['svitagovi' => $svitagovi]);
    }

    // submit dugme za stranicu uklanjanja tagova
    public function removeTags2(Request $request){
        $povratna = 0;
    if(!empty($request->input('tagovi'))){
        $tagovi = $request->input('tagovi');

        if(!empty($tagovi)){
        foreach ($tagovi as $tag) {
            $jedan = SviTagovi::find($tag);
            if(!empty($jedan)){
            $jedan->delete();
            $povratna = 1;
            }
        }
        }
    }
        $svitagovi = SviTagovi::all();

        return response()->json(['svitagovi' => $svitagovi, 'povratna' => $povratna, 'status' => 1]);
    }

    // upgradovanje uloga korsinika
    public function upgradeUserRoles(){
        return view('bogdan/upgradeUserRoles');
    }

    // submit dugme za stranicu unapredjivanja korisnika
    public function upgradeUserRolesSubmit(Request $request){

        $svi = SviKorisnici::all();
        $povr = "<div style = 'color:red'>User with given username doesn't exist!</div>";
        $trenId = -1;
        foreach ($svi as $jedan) {
            if($jedan['Username'] == $request['usernameUK'])
            {
                $povr = "<div style = 'color:blue'>Success!</div>";
                $trenId = $jedan['IDUser']; 
                break;
            }
        }

        if($trenId != -1){
            $isModerator = SviModeratori::find($trenId);
            $isAdministrator = SviAdministratori::find($trenId);

            if(!empty($isAdministrator)){
                $povr = "<div style = 'color: red'>User is already an administrator!</div>";

            }else if(!empty($isModerator)){
                if($request['ulogaUK'] == 'Administrator'){
                    $tekuci = SviModeratori::find($trenId);
                    $tekuci->delete();

                    $novi = new SviAdministratori;
                    $novi->IDUser = $trenId;
                    $novi->save();
                }else{
                    $povr = "<div style = 'color: red'>User is already a moderator!</div>";
                }
            }else{
                if($request['ulogaUK'] == 'Administrator'){
                    $novi = new SviAdministratori;
                    $novi->IDUser = $trenId;
                    $novi->save();
                }else{
                    $novi = new SviModeratori;
                    $novi->IDUser = $trenId;
                    $novi->save();
                }
            }
        }

        return response()->json(['status'=>1, 'msg'=>$povr]);
    }

}
