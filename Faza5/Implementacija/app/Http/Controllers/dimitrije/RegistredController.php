<?php

namespace App\Http\Controllers\dimitrije;

use App\Http\Controllers\Controller;
use App\Models\dimitrije\AdministratorModel;
use App\Models\dimitrije\ModeratorModel;
use App\Models\dimitrije\RegistredModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistredController extends Controller
{
    // function __construct() {
    //     $this->middleware('auth');
    // }

    public function auction() 
    {
        return view('dimitrije/auction');
    }

    public function deleteAccount()
    {
        return view('dimitrije/deleteAccount');
    }
    public function deleteAccountSubmit(Request $request)
    {
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


}


