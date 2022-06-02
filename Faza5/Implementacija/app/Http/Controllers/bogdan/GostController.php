<?php
// Bogdan Arsic 329/19
// kontroler koji pokriva funkcionalnost gosta

namespace App\Http\Controllers\bogdan;

use App\Http\Controllers\Controller;
use App\Models\bogdan\SviTagovi;
use App\Models\bogdan\SviModeratori;
use App\Models\bogdan\SviAdministratori;
use App\Models\bogdan\SviKorisnici;
use App\Models\bogdan\SveSlike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class GostController extends Controller
{
    function __construct() {
        $this->middleware('guest_v2');
    }
    // kontroler za login
    public function login(){
        return view('bogdan/login', ['body_id' => 'aboutus_body']);
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

        // if(!auth()->attempt($request->only('Username','Password'))){
        //    return back()->with('status','Bad credentials!');
        // }

        $id = -1;
        $svi = SviKorisnici::all();
        foreach ($svi as  $jedan) {
            if($request['username'] == $jedan->Username){
                $id = $jedan->IDUser;
                break;
            }
        }
        if($id == -1){
            return back()->with('status',"Username doesn't exist!");
        }
        $lozinka = SviKorisnici::find($id)->Password;
        if($lozinka != $request['password']){
            return back()->with('status',"Password is not correct!");
        }

        Session::put('IDUser',$id);
        Session::put('Username',$request['username']);
        Session::put('E_mail',$request['email']);

        $isModerator = SviModeratori::find($id);
        $isAdministrator = SviAdministratori::find($id);

        if(!empty($isModerator)){
            Session::put('privilegije','Moderator');
        }else if(!empty($isAdministrator)){
            Session::put('privilegije','Administrator');
        }else{
            Session::put('privilegije','Obicni');
        }
        
       return redirect()->route('indexInit');
    }

    // kontroler za register
    public function register(){
        return view('bogdan/register', ['body_id' => 'aboutus_body']);
    }

    // kontroler za register
    public function registerSubmit(Request $request){
        //return response()->json(['status'=>1, 'msg'=>'whats popin']);
        $regex1 = '/^\w{3,29}$/';
        $regex2 = '/^\w{8,29}$/';
        $regex3 = '/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/';
        $regex4 = '/^.{3,29}$/';
        $regex5 = '/^\d{6,10}$/';
        $regex6 = '/^\d{3,3}$/';

        if(preg_match($regex1, $request['username']) && preg_match($regex2, $request['password']) &&
            preg_match($regex3, $request['email']) && preg_match($regex4, $request['email']) &&
            ($request['password2'] == $request['password']) && preg_match($regex5, $request['brojKartice'])
            && preg_match($regex6, $request['ccvKartice']) && $request['iznos'] >= 0 
            && $request['iznos'] <= 10000000) 
            {
                $svi = SviKorisnici::all();

                foreach ($svi as $jedan) {
                    if(strtolower($jedan->Username) == strtolower($request['username'])){
                        return response()->json(['status'=>1, 'msg'=>'Username is already taken!']);
                    }
                    if(strtolower($jedan->E_mail) == strtolower($request['email'])){
                        return response()->json(['status'=>2, 'msg'=>'Email is already taken!']);
                    }
                }

                $novi = new SviKorisnici;
                $novi->Username = $request['username'];
                $novi->E_mail = $request['email'];
                $novi->Balance = $request['iznos'];
                $novi->CardNmber = $request['brojKartice'];
                $novi->Password = $request['password'];
                $novi->IsBanned = '0';
                $novi->CCV = $request['ccvKartice'];
                if($request['zelimHotAukcijeNaMail']){
                    $novi->FlagHotAuctions = '1';
                }
                else{
                    $novi->FlagHotAuctions = '0';
                }
                if($request['obavestMeOKrajuAukcije']){
                    $novi->FlagNotifyEnding = '1';
                }else{
                    $novi->FlagNotifyEnding = '0';
                }
                $novi->save();
                return response()->json(['status'=>0, 'msg'=>'Success!']);
            }else{
                return response()->json(['status'=>3, 'msg'=>'Data is not in right format!']);
            }

    }

    public function test2(){
        if(empty(Session::get('privilegije'))){
            return "Empty";
        }
        return Session::get('privilegije');
    }

    public function test3(){
        $slike = SveSlike::all();
        return view('bogdan/TestView', compact('slike'));
        //return view('bogdan/TestView',['slike' => $slike]);
    }

    public function test4(){
        $msg = "First line of text\nSecond line of text";

        // use wordwrap() if lines are longer than 70 characters
        $msg = wordwrap($msg,70);

        // send email
        mail("ab190329d@student.etf.bg.ac.rs","My subject",$msg);

        return "Uspeh";
    }
}


