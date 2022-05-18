<?php
// Bogdan Arsic 329/19
// kontroler koji pokriva funkcionalnost registrovanog korisnika
namespace App\Http\Controllers\bogdan;

use App\Http\Controllers\Controller;
use App\Models\bogdan\SviTagovi;
use App\Models\bogdan\SviKorisnici;
use App\Models\bogdan\SviAdministratori;
use App\Models\bogdan\SviModeratori;
use Illuminate\Http\Request;


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
        return view('bogdan/createAuctionVirtual');
    }

    // dodavanje aukcije fizicke slike
    public function createAuctionPhysical(){
        return view('bogdan/createAuctionPhysical');
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
