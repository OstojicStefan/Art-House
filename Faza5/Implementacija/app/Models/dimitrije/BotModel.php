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
            $newMaxUser = RegistredModel::find($botRow['IDUser']);
            if($botRow['MaxPrice'] > $auction['Price']){
                $user->Balance += $auction['Price'];
                
                $auction->Price = ($botRow['MaxPrice'] < $auction['Price']+10) ? $botRow['MaxPrice'] : $auction['Price']+10;
                $auction->HighestBidder = $botRow['IDUser'];
                $newMaxUser->Balance -= $oldMax;
                $newMaxUser->save();
                $auction->save();
                $user->save();
            } else {
                $newMaxUser->Balance += $botRow['MaxPrice'];
            }
        }
    }
}
