<?php

namespace App\Http\Controllers\nikola;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\nikola\Auction;
use App\Models\nikola\Exhibition;
use App\Models\nikola\Registred;
use App\Models\bogdan\SviTagovi;

class GostController extends Controller
{
    // function __construct() {
    //     $this->middleware('guest_v2', ['except' => [
    //         ''
    //     ]]);
    // }
    public function auctions()
    {
        $auctions = Auction::all();
        $tags = SviTagovi::all('Name');
        return view('nikola/auctions', ['body_id' => 'aboutus_body'], ['auctions' => $auctions, 'tags' => $tags]);
    }

    public function foundAuctions(Request $request)
    {
        //name,author,tag,type,status

        $tags = SviTagovi::all();
        $auctions = Auction::findAuctions($request);
        return view('nikola/auctions', ['body_id' => 'aboutus_body'], ['auctions' => $auctions, 'searched' => true, 'tags' => $tags]);
    }

    public function exhibitions()
    {
        $exhibitions = Exhibition::all();
        return view('nikola/all_exhibitions', ['body_id' => 'aboutus_body'], ['exhibitions' => $exhibitions]);
    }

    public static function findOrganizer($iduser)
    {
        return Registred::where('IDUser', '=', "$iduser");
    }

    public function foundExhibitions(Request $request)
    {
        $exhibitions = Exhibition::findExhibitions($request);
        return view('nikola/all_exhibitions', ['body_id' => 'aboutus_body'], ['exhibitions' => $exhibitions, 'searched' => $request->name]);
    }
}
