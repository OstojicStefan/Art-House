<?php
// Bogdan Arsic 329/19
// kontroler koji pokriva funkcionalnost gosta

namespace App\Http\Controllers\bogdan;

use App\Http\Controllers\Controller;
use App\Models\bogdan\SviTagovi;
use Illuminate\Http\Request;

class GostController extends Controller
{
    // kontroler za login
    public function login(){
        return view('bogdan/login');
    }

    // kontroler za register
    public function register(){
        return view('bogdan/register');
    }

}
