<?php
// Bogdan Arsic 329/19
// kontroler koji pokriva funkcionalnost gosta

namespace App\Http\Controllers\bogdan;

use App\Http\Controllers\Controller;
use App\Models\bogdan\SviTagovi;
use App\Models\bogdan\SviModeratori;
use App\Models\bogdan\SviAdministratori;
use Illuminate\Http\Request;

class GostController extends Controller
{
    // kontroler za login
    public function login(){
        return view('bogdan/login');
    }

    // funkcija koja se poziva klikom na dugme 
    public function loginSubmit(Request $request){
        $this->validate($request,[
            'username' => 'required|min:3',
            'password' => 'required|min:4'
        ],[
            'required' => 'Field :attribute is required',
            'min' => 'Field :attribute has to be at least :min characters'
        ]);

        //auth()->attempt([
         //   'Username' => $request->username,
        //    'Password' => $request->password
        //])

        if(!auth()->attempt($request->only('username','password'))){
            return back()->with('status','Bad credentials');
        }

        $isModerator = SviModeratori::find(auth()->user()->IDUser);
        $isAdministrator = SviAdministratori::find(auth()->user()->IDUser);

        if(!empty($isModerator)){
            $request->session()->put('privilegije','Moderator');
        }else if(!empty($isAdministrator)){
            $request->session()->put('privilegije','Administrator');
        }else{
            $request->session()->put('privilegije','Obicni');
        }


        return view('bogdan/login');

    }

    // kontroler za register
    public function register(){
        return view('bogdan/register');
    }

}
