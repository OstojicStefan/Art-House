<?php
//Dimitrije Plavsic 18/220
namespace App\Models\dimitrije;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

//model za tabelu botova
class BotModel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'bot';
    protected $primaryKey = 'IDBot';
    protected $fillable = [
        'IDUser',
        'IDAuc',
        'MaxPrice'
    ];

    public static function findMaxBid($idauc){
        return BotModel::where('IDAuc', $idauc)->first();           //vraca prvi jer ce se uvek pratiti samo maksimalni bot
    }

    public static function biddingBots($idauc, $auction, $user, $oldMax){
        if(($botRow = BotModel::where('IDAuc', $idauc)->first()) != null){
            $botUser = RegistredModel::find($botRow['IDUser']);
            $botUser->Balance -= $oldMax;                //ovo se radi jer su mu te pare vracene kad mu je trenutni bid "presao" bota
            $botUser->save();
            if($botRow['MaxPrice'] >= $auction['Price']){
                $user->Balance += $auction['Price'];
                
                $auction->Price = ($botRow['MaxPrice'] < $auction['Price'] + 10) ? $botRow['MaxPrice'] : $auction['Price'] + 10;
                $auction->HighestBidder = $botRow['IDUser'];                
                $auction->save();
                $user->save();
            } else {
                $botUser->Balance += $botRow['MaxPrice'];
            }            
            $botUser->save();
        }
    }
}
