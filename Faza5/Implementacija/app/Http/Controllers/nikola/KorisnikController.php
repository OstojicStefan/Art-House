<?php

namespace App\Http\Controllers\nikola;

use App\Http\Controllers\Controller;
use App\Models\bogdan\SveIzlozbe;
use App\Models\bogdan\SveSlike;
use App\Models\bogdan\SviTagovi;
use App\Models\nikola\Auction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\nikola\Registred;
use App\Models\nikola\Exhibition;
use App\Models\nikola\Image;
use App\Models\nikola\ImageOnExhibition;
use App\Models\nikola\ImageWithTags;
use App\Models\nikola\PhysicalAuction;
use App\Models\stefan\AllMessages;


class KorisnikController extends Controller
{
    function __construct()
    {
        $this->middleware('registred');
    }
    public function depositMoney()
    {
        return view('nikola/deposit_money', ['body_id' => 'aboutus_body']);
    }

    public function depositMoneySubmit(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required|gt:0|numeric'
        ]);
        Registred::updateBalance(Session::get('IDUser'), $request->amount);
        return redirect()->route('auctions');
    }

    public function auction($idauc)
    {
        $auction = Auction::find($idauc);
        $auction_owner = Registred::find($auction->Owner);
        $image = Image::find($auction->IDIm);
        $images_with_tag = ImageWithTags::all();
        $temp = 0;
        foreach ($images_with_tag as $image_with_tag) {
            if ($image_with_tag->IDIm == $image->IDIm) {
                $temp = $image_with_tag->IDTag;
            }
        }
        $tag = SviTagovi::find($temp);
        $tag_name = $tag->Name;
        $is_physical = PhysicalAuction::find($idauc);
        $highest_bidder = Registred::find($auction->HighestBidder);
        Auction::updateViewCount($idauc);
        $has_privileges = false;
        if (Session::get('privilegije') == 'Administrator' || Session::get('privilegije') == 'Moderator')
            $has_privileges = true;
        return view('nikola/auction', ['body_id' => 'aboutus_body'], ['auction' => $auction, 'owner' => $auction_owner, 'image' => $image, 'tag' => $tag_name, 'highest_bidder' => $highest_bidder, 'isPhysical' => $is_physical, 'has_privileges' => $has_privileges]);
    }

    public function exhibition($idexh)
    {
        $exhibition = Exhibition::find($idexh);
        $organizer = Registred::find($exhibition->IDUser);
        $images_on_exhibiton = ImageOnExhibition::where('IDExh', '=', $exhibition->IDExh)->get();
        $images = array();
        $descriptions = array();
        foreach ($images_on_exhibiton as $image) {
            $temp = Image::find($image->IDIm);
            $temp_desc = $image->Description;
            array_push($images, $temp);
            array_push($descriptions, $temp_desc);
        }

        $has_privileges = false;
        if (Session::get('privilegije') == 'Administrator' || Session::get('privilegije') == 'Moderator')
            $has_privileges = true;
        $authors = array();
        foreach ($images as $image) {
            $author = Registred::find($image->IDUser);
            array_push($authors, $author);
        }
        $id = Session::get('IDUser');

        $allMessages = new AllMessages();

        $chatbox = $allMessages->where('IDExh', $idexh)->orderBy('IDMes', 'asc')->get();
        ////////////////////////////////////////////
        Session::put('trenutnaIzlozba',$idexh);
        ////////////////////////////////////////////////
        return view('nikola/exhibition', ['body_id' => 'aboutus_body'], ['exhibition' => $exhibition, 'organizer' => $organizer, 'images' => $images, 'authors' => $authors, 'descriptions' => $descriptions, 'has_privileges' => $has_privileges, 'chatbox' => $chatbox]);
    }

    public function rateExhibition(Request $request)
    {
        if(empty(Session::get('trenutnaIzlozba'))){
            return response()->json(['status'=>2]);
        }
        $izlozba = SveIzlozbe::find(Session::get('trenutnaIzlozba'));
        if(empty($izlozba)){
            return response()->json(['status'=>2]);
        }
        if($izlozba->IsActive == 0){
            return response()->json(['status'=>3]);
        }
        
        $izlozba->RatingCount = $izlozba->RatingCount + 1;
        $izlozba->Rating = ($izlozba->Rating * ($izlozba->RatingCount-1) + $request->rate)/$izlozba->RatingCount;
        $izlozba->save();
        return response()->json(['status'=>1, 'msg'=>$izlozba->Rating, 'trenutnaIzlozba'=>Session::get('trenutnaIzlozba')]);
    }
}
