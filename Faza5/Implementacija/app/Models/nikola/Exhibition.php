<?php

namespace App\Models\nikola;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exhibition extends Model
{
    use HasFactory;

    protected $table = 'exhibition';
    protected $primaryKey = 'IDExh';
    public $timestamps = false;

    protected $fillable = [
        'Name', 'Date', 'IsActive', 'IDUser', 'AccumulatedDonations'
    ];

    public static function findExhibitions($request)
    {
        $exhibitions = "";
        if ($request->type == 'All') {
            $exhibitions = Exhibition::where('Name', 'like', "%$request->name%")->get();
        } else if ($request->type == 'Active') {
            $exhibitions = Exhibition::where('Name', 'like', "%$request->name%")->where('IsActive', '=', '1')->get();
        } else {
            $exhibitions = Exhibition::where('Name', 'like', "%$request->name%")->where('IsActive', '=', '0')->get();
        }
        return $exhibitions;
    }

    //proverava da li je prosledjeni korisnik vlasnik na bilo kojoj egzibiciji
    public static function isUserOwner($idU)
    {
        return Exhibition::where('IDUser', $idU)->first();
    }

    public static function donateMoney($idUsr, $idExh, $amount)
    {

        $user = Registred::find($idUsr);
        if ($user->Balance > $amount) {
            $amount = -$amount;
            Registred::updateBalance($idUsr, $amount);
            $exhibition = Exhibition::find($idExh);
            $amount = -$amount;
            $exhibition->AccumulatedDonations = $exhibition->AccumulatedDonations + $amount;
            $exhibition->save();
        }
    }
}
