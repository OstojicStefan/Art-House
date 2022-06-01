<?php
// Bogdan Arsic 329/19
// Kontroler koji pokriva funkcionalnosti Moderatora
namespace App\Http\Controllers\bogdan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\bogdan\SviTagovi;
use Exception;

class ModeratorController extends Controller
{
    // dodavanje taga(vraca stranicu)
    public function addTags(){
        return view('bogdan/addTags');
    }

    // submit dugme za stranicu dodavanja taga
    public function addTagsSubmit(Request $request){
        $regex = '/^[a-zA-Z0-9_ ]{3,30}$/';
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

    // uklanjanje tagova(vraca stranicu)
    public function removeTags(){
        $svitagovi = SviTagovi::all();

        return view('bogdan/removeTags', ['svitagovi' => $svitagovi]);
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
                try {
                    $jedan->delete();
                } catch (Exception $e) {
                    $svitagovi = SviTagovi::all();
                    return response()->json(['svitagovi' => $svitagovi, 'povratna' => 2, 'status' => 2]);
                }
            $povratna = 1;
            }
        }
        }
    }
        $svitagovi = SviTagovi::all();

        return response()->json(['svitagovi' => $svitagovi, 'povratna' => $povratna, 'status' => 1]);
    }
}
