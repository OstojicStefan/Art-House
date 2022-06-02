<?php
//Dimitrije Plavsic 18/220
namespace App\Http\Controllers\dimitrije;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\dimitrije\RegistredModel;
use App\Models\dimitrije\ModeratorModel;
use App\Models\dimitrije\AdministratorModel;
use App\Http\Controllers\dimitrije\ModeratorController;
use App\Models\nikola\Auction;
use App\Models\nikola\Exhibition;

/* klasa za funkcionalnosti administratora */

class AdminController extends Controller
{
    //kreiranje nove instance i dodavanje middleware-a
    function __construct() {
        $this->middleware('admin', ['except' => [
            'testing'
        ]]);
    }

    //metoda koja izbacuje view za brisanje naloga od strane admina
    public function adminDeleteAccount()
    {
        return view('dimitrije/adminDeleteAccount', ['body_id' => 'aboutus_body']);
    }

    //submit unetog korisnika kojeg admin zeli obrisati
    public function adminDeleteAccountSubmit(Request $request)
    {
        $username = $request['usernameInput'];
        $users = RegistredModel::all();
        foreach ($users as $user) {
            if($user['Username'] == $username) {
                if(Auction::isUserBidder($user['IDUser'])) return back()->with('status', "You cannot delete an account while they're the highest bidder at an auction!");
                else if ( Auction::isUserOwner($user['IDUser'])) return back()->with('status', "You cannot delete an account while they're the owner of an auction!");
                else if(Exhibition::isUserOwner($user['IDUser'])) return back()->with('status', "You cannot delete an account while they're the owner of an exhibition!");

                $isAdmin = AdministratorModel::find($user['IDUser']);
                if($isAdmin == null){
                    $user->delete();
                    $ret = "Account deletion successful!";
                } else {
                    $ret = "Cannot delete an administrator's account.";
                }
                return back()->with('status', $ret);
               // return redirect('/adminDeleteAccount')->with('status', $ret);
            }
        }
        $ret = "User with given username does not exist!";
        return back()->with('status', $ret);               
    }

    //metoda koja izbacuje view za ukidanja uloga moderatora od strane admina
    public function downgradeModerator()
    {
        return view('dimitrije/downgradeModerator');
    }

    //submit unetog moderatora kojem admin zeli ukinuti uloge
    public function downgradeModeratorSubmit(Request $request){

        $users = RegistredModel::all();
        $id = -1;
        foreach ($users as $u) {
            if($u['Username'] == $request['usernameInput'])
            {
                $id = $u['IDUser'];                 
                break;
            }
        }

        if($id != -1){
            $isModerator = ModeratorModel::find($id);
            if(!empty($isModerator)){
                $isModerator->delete();
                $ret = 'Account successfully downgraded!';
                
            } else {
                $ret = "Provided account isn't a moderator account";
            }
        } else {
            $ret = "User with given username does not exist!";
        }

        return back()->with('status', $ret);
    }

    //metoda za testiranje sesija
    public function testing(){
        return dd(session()->getDrivers()['file']);
    }
}
