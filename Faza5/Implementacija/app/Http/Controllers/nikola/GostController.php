<?php

namespace App\Http\Controllers\nikola;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\nikola\Auction;
use App\Models\nikola\Exhibition;
use App\Models\nikola\Registred;

class GostController extends Controller
{
    public function auctions()
    {
        $auctions = Auction::all();
        return view('nikola/auctions', ['auctions' => $auctions]);
    }

    public function foundedAuctions(Request $request)
    {
        //name,author,tag,type,status

        $auctions = Auction::findAuctions($request);
        return view('nikola/auctions', ['auctions' => $auctions, 'searched' => $request->name]);
    }

    public function exhibitions()
    {
        $exhibitions = Exhibition::all();
        return view('nikola/all_exhibitions', ['exhibitions' => $exhibitions]);
    }

    public static function findOrganizer($iduser)
    {
        return Registred::where('IDUser', '=', "$iduser");
    }

    public function foundedExhibitions(Request $request)
    {
        $exhibitions = Exhibition::findExhibitions($request);
        return view('nikola/all_exhibitions', ['exhibitions' => $exhibitions, 'searched' => $request->name]);
    }
}
