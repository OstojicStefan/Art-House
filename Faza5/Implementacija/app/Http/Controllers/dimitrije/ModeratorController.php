<?php

namespace App\Http\Controllers\dimitrije;

use App\Http\Controllers\dimitrije\RegistredController;
use App\Models\dimitrije\RegistredModel;
use Illuminate\Http\Request;

class ModeratorController extends RegistredController
{
    public function banning()
    {
        return view('dimitrije/banning');
    }
    public function banningSubmit(Request $request)
    {
        $username = $request['usernameInput'];
        $users = RegistredModel::all();
        foreach ($users as $user) {
            if($user['Username'] == $username)
            {
                if ($user['IsBanned'] == 0){
                    $user->IsBanned = 1;                              
                    $user->save();
                    $ret = "Account successfully banned!";
                } else {
                    $ret = "Account was already banned.";
                }
                return back()->with('status', $ret);              
            }
        }
        $ret = "User with provided username does not exist.";
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
}
