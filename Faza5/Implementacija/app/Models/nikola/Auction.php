<?php

namespace App\Models\nikola;

use App\Models\bogdan\SviTagovi;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Auction extends Model
{
    use HasFactory;

    protected $table = 'auction';
    protected $primaryKey = 'IDAuc';
    public $timestamps = false;

    protected $fillable = [
        'Name', 'Author', 'IsActive', 'Price', 'HighestBidder'
    ];

    public static function findAuctions(Request $request)
    {
        $author_name = $request->author;
        $auction_name = $request->name;
        $tag = $request->tag;
        $auction_type = $request->type;
        $auction_status = $request->status;

        //first check author and name, then check tags, then check type, then check status
        $auctions = Auction::where('Name', 'like', "%$request->name%")
            ->where('Author', 'like', "%$request->author%")
            ->get();

        $auctions_checked_tags = array();
        if ($tag != 'All') {
            $tags = SviTagovi::all();
            $tag_id = '';
            foreach ($tags as $founded_tag) {
                if ($founded_tag->Name == $tag) {
                    $tag_id = $founded_tag->IDTag;
                }
            }
            $images_with_tags = ImageWithTags::all();
            foreach ($auctions as $auction) {
                $img_id = $auction->IDIm;
                foreach ($images_with_tags as $image) {
                    if ($img_id == $image->IDIm && $tag_id == $image->IDTag)
                        array_push($auctions_checked_tags, $auction);
                }
            }
        } else {
            $auctions_checked_tags = $auctions;
        }
        $auctions_checked_type = array();
        if ($auction_type !=  'All') {
            if ($auction_type == 'Physical') {
                foreach ($auctions_checked_tags as $act) {
                    $is_physical = PhysicalAuction::find($act->IDAuc);
                    if ($is_physical != null) {
                        array_push($auctions_checked_type, $act);
                    }
                }
            } else {
                foreach ($auctions_checked_tags as $act) {
                    $is_virtual = VirtualAuction::find($act->IDAuc);
                    if ($is_virtual != null) {
                        array_push($auctions_checked_type, $act);
                    }
                }
            }
        } else {
            $auctions_checked_type = $auctions_checked_tags;
        }

        $auctions_checked_status = array();
        if ($auction_status != 'All') {
            if ($auction_status == 'Active') {
                foreach ($auctions_checked_type as $act) {
                    if ($act->IsActive == '1') {
                        array_push($auctions_checked_status, $act);
                    }
                }
            } else {
                foreach ($auctions_checked_type as $act) {
                    if ($act->IsActive == '0') {
                        array_push($auctions_checked_status, $act);
                    }
                }
            }
        } else {
            $auctions_checked_status = $auctions_checked_type;
        }
        return $auctions_checked_status;
    }

    //proverava da li je prosledjeni korisnik vodeci bider na bilo kojoj aukciji
    public static function isUserBidder($idU)
    {
        return Auction::where('HighestBidder', $idU)->first();
    }

     //proverava da li je prosledjeni korisnik vlasnik na bilo kojoj aukciji
     public static function isUserOwner($idU)
     {
         return Auction::where('Owner', $idU)->first();
     }
}
