<?php

namespace App\Http\Controllers\dimitrije;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\dimitrije\RegistredModel;
use App\Models\dimitrije\ModeratorModel;
use App\Models\dimitrije\AdministratorModel;
use App\Http\Controllers\dimitrije\ModeratorController;


class AdminController extends Controller
{
    function __construct() {
        $this->middleware('admin', ['except' => [
            'testing'
        ]]);
    }

    public function adminDeleteAccount()
    {
        return view('dimitrije/adminDeleteAccount', ['body_id' => 'aboutus_body']);
    }
    public function adminDeleteAccountSubmit(Request $request)
    {
        $username = $request['usernameInput'];
        $users = RegistredModel::all();
        foreach ($users as $user) {
            if($user['Username'] == $username) {
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

    public function downgradeModerator()
    {
        return view('dimitrije/downgradeModerator');
    }


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

    public function testing(){
        return dd(session()->getDrivers()['file']);
    }
}
