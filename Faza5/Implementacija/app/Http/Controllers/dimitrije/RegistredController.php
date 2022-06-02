<?php

namespace App\Http\Controllers\dimitrije;

use App\Http\Controllers\Controller;
use App\Models\dimitrije\AdministratorModel;
use App\Models\dimitrije\ModeratorModel;
use App\Models\dimitrije\RegistredModel;
use App\Models\nikola\Auction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistredController extends Controller
{
    function __construct() {
        $this->middleware('registred');
    }
    public function deleteAccount(){
        return view('dimitrije/deleteAccount', ['body_id' => 'aboutus_body']);
    }
    public function deleteAccountSubmit(Request $request){
        $idU = $request->session()->get('IDUser');
        $user = RegistredModel::find($idU);
        if($user != null){            
            $adm = AdministratorModel::find($idU);
            if($adm != null){
                $adm->delete();
            }
            Auth::logout();         //$request->session()->flush();
            $user->delete();
            $ret = "Account deletion successful!";
            return redirect('/login')->with('status', $ret);
        }
        return redirect()->route('login');
    }

    public function bidding($idauc, Request $request){
        $idU = $request->session()->get('IDUser');
        $user = RegistredModel::find($idU);
        $bid = $request['bidInput'];        
        if(($auction = Auction::find($idauc)) != null){
            if($auction['isActive'] == 0){
                $ret = "The auction has finished! You cannot bid anymore.";
            } else {
                //provera ispravnosti unetog bida i da li ima toliko novca na racunu; 
                //da li u auction->price stoji pocetna cena aukcije ili maks bid?
                //kada ide skidanje novca sa racuna?
            }
        }
    }
    public function biddingBot(){
        
    }
}


