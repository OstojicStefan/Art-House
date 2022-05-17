<?php
// Bogdan Arsic 329/19
// kontroler koji pokriva funkcionalnost registrovanog korisnika
namespace App\Http\Controllers\bogdan;

use App\Http\Controllers\Controller;
use App\Models\bogdan\SviTagovi;
use Illuminate\Http\Request;

class RegistrovaniKontroler extends Controller
{
    // dodavanje taga
    public function addTags(){
        $novi = new SviTagovi;
        $novi->Name = "noviii";
        $novi->save();

        return view('bogdan/addTags');
    }

    // submit dugme za dodavanje taga
    public function addTagsSubmit(Request $request){
        $novi = new SviTagovi;
        $novi->Name = $request['imeTaga'];
        $novi->save();

        return view('bogdan/addTags');
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
        $tagovi = $request->input('tagovi');

        $povratna = 0;

        if(!empty($tagovi)){
        foreach ($tagovi as $tag) {
            $jedan = SviTagovi::find($tag);
            $jedan->delete();
            $povratna = 1;
        }
        }
        $svitagovi = SviTagovi::all();

        return view('bogdan/removeTags', ['svitagovi' => $svitagovi, 'povratna' => $povratna]);
    }

}
