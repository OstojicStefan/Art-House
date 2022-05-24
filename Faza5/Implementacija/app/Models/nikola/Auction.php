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
    protected $primaryKey = 'idauc';

    protected $fillable = [
        'name', 'author'
    ];

    public static function findAuctions(Request $request)
    {
        $auctions = "";
        $phy_auctions = PhysicalAuction::all();
        $vir_auctions = VirtualAuction::all();
        //name,author,tag,type,status
        $tag = SviTagovi::where('Name', '=', "$request->tag")->get();
        //status,type
        //all all
        if ($request->status == 'All' && $request->type == 'All') {
            $auctions = Auction::where('Name', 'like', "%$request->name%")
                ->where('Author', 'like', "%$request->author%")
                //->where('IdTag', '=', "$tag->IDTag")
                ->get();
        }
        //all phy
        else if ($request->status == 'All' && $request->type == 'Physical') {
            $auctions = Auction::where('Name', 'like', "%$request->name%")
                ->where('Author', 'like', "%$request->author%")
                //->where('IdTag', '=', "$tag->IDTag")
                ->where('IDAuc', '=', $phy_auctions)
                ->get();
        }
        //all vir
        else if ($request->status == 'All' && $request->type == 'Virtual') {
            $auctions = Auction::where('Name', 'like', "%$request->name%")
                ->where('Author', 'like', "%$request->author%")
                //->where('IdTag', '=', "$tag->IDTag")
                ->where('IDAuc', 'in', $vir_auctions)
                ->get();
        }
        //act all
        else if ($request->status == 'Active' && $request->type == 'All') {
            $auctions = Auction::where('Name', 'like', "%$request->name%")
                ->where('Author', 'like', "%$request->author%")
                //->where('IdTag', '=', "$tag->IDTag")
                ->where('IsActive', '=', "t")
                ->get();
        }
        //act phy
        else if ($request->status == 'Active' && $request->type == 'Physical') {
            $auctions = Auction::where('Name', 'like', "%$request->name%")
                ->where('Author', 'like', "%$request->author%")
                //->where('IdTag', '=', "$tag->IDTag")
                ->where('IsActive', '=', 't')
                ->where('IDAuc', 'in', $phy_auctions)
                ->get();
        }
        //act vir
        else if ($request->status == 'Active' && $request->type == 'Virtual') {
            $auctions = Auction::where('Name', 'like', "%$request->name%")
                ->where('Author', 'like', "%$request->author%")
                //->where('IdTag', '=', "$tag->IDTag")
                ->where('IsActive', '=', 't')
                ->where('IDAuc', 'in', $vir_auctions)
                ->get();
        }
        //ex all
        else if ($request->status == 'Expired' && $request->type == 'All') {
            $auctions = Auction::where('Name', 'like', "%$request->name%")
                ->where('Author', 'like', "%$request->author%")
                //->where('IdTag', '=', "$tag->IDTag")
                ->where('IsActive', '=', 'f')
                ->get();
        }
        //ex phy
        else if ($request->status == 'Expired' && $request->type == 'Physical') {
            $auctions = Auction::where('Name', 'like', "%$request->name%")
                ->where('Author', 'like', "%$request->author%")
                //->where('IdTag', '=', "$tag->IDTag")
                ->where('IsActive', '=', 'f')
                ->where('IDAuc', 'in', $phy_auctions)
                ->get();
        }
        //ex vir
        else if ($request->status == 'Expired' && $request->type == 'Virtual') {
            $auctions = Auction::where('Name', 'like', "%$request->name%")
                ->where('Author', 'like', "%$request->author%")
                //->where('IdTag', '=', "$tag->IDTag")
                ->where('IsActive', '=', 'f')
                ->where('IDAuc', 'in', $vir_auctions)
                ->get();
        }
        return $auctions;
    }
}
