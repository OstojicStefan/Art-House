<?php
// Bogdan Arsic 329/19
// Kontroler koji pokriva funkcionalnosti registrovanog korisnika
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
use Exception;


class RegistrovaniKontroler extends Controller
{

    // dodavanje aukcije virtuelne slike(vraca stranicu)
    public function createAuctionVirtual(){

        $svitagovi = SviTagovi::all();

        return view('bogdan/createAuctionVirtual', ['svitagovi' => $svitagovi]);
    }

    // submit dugme na stranici dodavanja aukcije fizicke ili virtuelne slike
    public function createAuctionSubmit(Request $request){

        $vremeTrajanja = $request['vremeTrajanja'];
        $pocetnaCena = $request['pocetnaCena'];
        $godinaSlikanja = $request['godinaSlikanja'];
        $Autor = $request['Autor'];
        $opisniTekst = $request['opisniTekst'];
        $imeSlike = $request['imeSlike'];
        $physicalVirtual = $request['PhysicalVirtual'];

        //definisanje regex-a
        $vremeTrajanjaRegex = '/^\d+$/';
        $pocetnaCenaRegex = '/^\d+$/';
        $locationRegex = '/^[a-zA-Z0-9_ ]{4,50}$/';
        $godinaSlikanjaRegex = '/^\d+$/';
        $AutorRegex = '/^[a-zA-Z0-9_ ]{3,30}$/';
        $opisniTekstRegex = '/^.{10,512}$/';
        $imeSlikeRegex = '/^[a-zA-Z0-9_ ]{4,30}$/';

        if(preg_match($vremeTrajanjaRegex, $vremeTrajanja) && preg_match($pocetnaCenaRegex, $pocetnaCena) &&
        preg_match($godinaSlikanjaRegex, $godinaSlikanja) && preg_match($AutorRegex, $Autor) &&
        preg_match($opisniTekstRegex, $opisniTekst) && preg_match($imeSlikeRegex, $imeSlike) && 
        $godinaSlikanja >= 0  && $godinaSlikanja <= 2022 && $vremeTrajanja > 0 && $vremeTrajanja <=30 &&
        $pocetnaCena > 0 && $pocetnaCena < 10000000000.000){

        if(empty($request->file('myfile'))) {
            return back()->with('status','Server Error: Input file not in right format!');
        }
        if(($request->file('myfile')->getClientOriginalExtension()!= 'jpg' &&
        $request->file('myfile')->getClientOriginalExtension() != 'png') ||
        $request->file('myfile')->getSize() > 1048576 || empty($request->file('myfile')->getSize()))
        {
            return back()->with('status','Server Error: Input file not in right format!');
        }

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
        }else{
            $novi->delete();
            return back()->with('status','Server Error: No tags were choosen!');
        }

        //ubacivanje u Auction
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

        return back()->with('status', "Success!");
    }
    else{
        return back()->with('status','Server Error: Input data not in right format!');
    }
    }

    // dodavanje aukcije fizicke slike(vraca stranicu)
    public function createAuctionPhysical(){
        $svitagovi = SviTagovi::all();

        return view('bogdan/createAuctionPhysical', ['svitagovi' => $svitagovi]);
    }


    //odjavljivanje od sajta(vraca se na login stranicu)
    public function logout(Request $request){
        $request->session()->flush();
        return redirect()->route('login');
    }   

}
