<?php
//Dimitrije Plavsic 18/220

namespace App\Http\Controllers\dimitrije;

use App\Http\Controllers\Controller;
use App\Http\Controllers\dimitrije\RegistredController;
use App\Models\dimitrije\RegistredModel;
use App\Models\dimitrije\AdministratorModel;
use App\Models\nikola\Auction;
use App\Models\nikola\Exhibition;
use Illuminate\Http\Request;

/* klasa za funkcionalnosti moderatora */

class ModeratorController extends Controller
{
    //kreiranje nove instance i dodavanje middleware-a
    function __construct() {
        $this->middleware('mod');
    }

    //metoda koja izbacuje view za banovanja naloga od strane moderatora
    public function banning()
    {
        return view('dimitrije/banning');
    }
    //submit unetog korisnika kojeg mod zeli banovati
    public function banningSubmit(Request $request)
    {
        $username = $request['usernameInput'];
        $users = RegistredModel::all();
        $f = true;
        foreach ($users as $user) {
            if($user['Username'] == $username)
            {
                if (AdministratorModel::find($user['IDUser']) != null) {
                    $ret = "An Administrator cannot be banned!";
                } else if ($user['IsBanned'] == 0){
                    $user->IsBanned = 1;                              
                    $user->save();
                    $ret = "Account successfully banned!";
                } else {
                    $ret = "Account was already banned.";
                }
                $f = false;
                break;             
            }
        }
        if($f){
            $ret = "User with provided username does not exist.";
        }      

        return back()->with('status', $ret);               
    }    

    //metoda koja izbacuje view za unbanovanje naloga od strane moderatora
    public function unbanning()
    {
        return view('dimitrije/unbanning');
    }
    //submit unetog korisnika kojeg mod zeli unbanovati
    public function unbanningSubmit(Request $request)
    {
        $username = $request['usernameInput'];
        $users = RegistredModel::all();
        foreach ($users as $user) {
            if($user['Username'] == $username)
            {
                if ($user['IsBanned'] == 1){
                    $user->IsBanned = 0;                              
                    $user->save();
                    $ret = "Account successfully unbanned!";
                } else {
                    $ret = "Account was not banned in the first place.";
                }
                return back()->with('status', $ret);              
            }
        }
        $ret = "User with provided username does not exist.";
        return back()->with('status', $ret);               
    } 

    //metoda kojom moderator brise aukciju
    public function cancelAuction($idauc) {
        $auc = Auction::find($idauc);
            if(!empty($auc)){
                //$auc['IsActive'] = 0;
                $auc->delete();
                $ret = "Auction " . $auc['Name'] . " was successfully deleted!";                
            } else {
                $ret = "Auction doesn't exist!";
            }

        return redirect()->route('auctions')->with('status', $ret);
    }
    //metoda kojom moderator brise egzibiciju
    public function cancelExhibition($idexh) {
        $exh = Exhibition::find($idexh);
            if(!empty($exh)){
                //$exh->IsActive = 0;
                $exh->delete();
                $ret = "Exhibition " . $exh['Name'] . " was successfully deleted!";        
            } else {
                $ret = "Exhibition doesn't exist!";
            }

        return redirect()->route('exhibitions')->with('status', $ret);
    }
}
