<?php


namespace App\Http\Controllers\bogdan;

use App\Http\Controllers\Controller;
use App\Models\bogdan\SviTagovi;
use Illuminate\Http\Request;

class GostController extends Controller
{
    public function login(){
        $tagovi = SviTagovi::all();
        
        return view('bogdan/login', ['tagovi' => $tagovi]);
    }
}
