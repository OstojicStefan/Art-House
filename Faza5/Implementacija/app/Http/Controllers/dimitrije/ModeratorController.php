<?php

namespace App\Http\Controllers\dimitrije;

use App\Http\Controllers\Controller;
use App\Http\Controllers\dimitrije\RegistredController;
use App\Models\dimitrije\RegistredModel;
use App\Models\dimitrije\AdministratorModel;
use App\Models\nikola\Auction;
use App\Models\nikola\Exhibition;
use Illuminate\Http\Request;

class ModeratorController extends Controller
{
    function __construct()
    {
        $this->middleware('mod');
    }

    public function banning()
    {
        return view('dimitrije/banning');
    }
    public function banningSubmit(Request $request)
    {
        $username = $request['usernameInput'];
        $users = RegistredModel::all();
        $f = true;
        foreach ($users as $user) {
            if ($user['Username'] == $username) {
                if (AdministratorModel::find($user['IDUser']) != null) {
                    $ret = "An Administrator cannot be banned!";
                } else if ($user['IsBanned'] == 0) {
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
        if ($f) {
            $ret = "User with provided username does not exist.";
        }



        return back()->with('status', $ret);
    }

    public function unbanning()
    {
        return view('dimitrije/unbanning');
    }
    public function unbanningSubmit(Request $request)
    {
        $username = $request['usernameInput'];
        $users = RegistredModel::all();
        foreach ($users as $user) {
            if ($user['Username'] == $username) {
                if ($user['IsBanned'] == 1) {
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

    public function cancelAuction($idauc)
    {
        $auc = Auction::find($idauc);
        if (!empty($auc)) {
            $auc['IsActive'] = 0;
            $auc->save();
            $ret = "Auction " . $auc['Name'] . " was successfully cancelled!";
        } else {
            $ret = "Auction doesn't exist!";
        }

        return redirect()->route('auctions')->with('status', $ret);
    }
    public function cancelExhibition($idexh)
    {
        $exh = Exhibition::find($idexh);
        if (!empty($exh)) {
            $exh->IsActive = 0;
            $exh->save();
            $ret = "Exhibition " . $exh['Name'] . " was successfully cancelled!";
        } else {
            $ret = "Exhibition doesn't exist!";
        }

        return redirect()->route('exhibitions')->with('status', $ret);
    }
}
