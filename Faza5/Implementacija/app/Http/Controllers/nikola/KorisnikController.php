<?php

namespace App\Http\Controllers\nikola;

use App\Http\Controllers\Controller;
use App\Models\bogdan\SviTagovi;
use App\Models\nikola\Auction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\nikola\Registred;
use App\Models\nikola\Exhibition;
use Illuminate\Auth\Events\Registered;
use App\Models\nikola\Image;
use App\Models\nikola\ImageOnExhibition;
use App\Models\nikola\ImageWithTags;

class KorisnikController extends Controller
{
    public function depositMoney()
    {
        if (empty(Session::get('privilegije')) || Session::get('privilegije') == 'gost')
            return view('bogdan/login');
        else
            return view('nikola/deposit_money');
    }

    public function depositMoneySubmit(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required|gt:0|numeric'
        ]);
        Registred::updateBalance(Session::get('IDUser'), $request->amount);
        return redirect()->route('index');
    }

    public function auction($idauc)
    {
        // if (empty(Session::get('privilegije')) || Session::get('privilegije') == 'gost')
        //   return view('bogdan/login');
        //else {
        $auction = Auction::find($idauc);
        $auction_owner = Registred::find($auction->Owner);
        $image = Image::find($auction->IDIm);
        $images_with_tag = ImageWithTags::all();
        $temp = '';
        foreach ($images_with_tag as $image_with_tag) {
            if ($image_with_tag->IDIm == $image->IDIm) {
                $temp = $image_with_tag->IDTag;
                break;
            }
        }
        $tag = SviTagovi::find($temp);
        //$image_with_tag = ImageWithTags::where('IDIm', '=', "$image->IDIm");
        //$tag = SviTagovi::where('idtag', '=', $image_with_tag->IDTag);
        return view('nikola/auction', ['auction' => $auction, 'owner' => $auction_owner, 'image' => $image, 'tag' => $tag]);
        //}
    }

    public function exhibition($idexh)
    {
        // if (empty(Session::get('privilegije')) || Session::get('privilegije') == 'gost')
        //   return view('bogdan/login');
        //else {
        $exhibition = Exhibition::find($idexh);
        $organizer = Registred::find($exhibition->IDUser);
        $images_on_exhibiton = ImageOnExhibition::where('IDExh', '=', $exhibition->IDExh)->get();
        $images = array();
        foreach ($images_on_exhibiton as $image) {
            array_push($images, $image);
        }
        return view('nikola/exhibition', ['exhibition' => $exhibition, 'organizer' => $organizer, 'images' => $images]);
        //}
    }
}
