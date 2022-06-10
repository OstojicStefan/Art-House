<?php
//Dimitrije Plavsic 18/220
namespace App\Http\Controllers\dimitrije;

use App\Http\Controllers\Controller;
use App\Models\dimitrije\AdministratorModel;
use App\Models\dimitrije\BotModel;
use App\Models\dimitrije\ModeratorModel;
use App\Models\dimitrije\RegistredModel;
use App\Models\nikola\Auction;
use App\Models\nikola\Exhibition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/* klasa za funkcionalnosti registrovanog korisnika */

class RegistredController extends Controller
{   
    //kreiranje nove instance i dodavanje middleware-a
    function __construct() {
        $this->middleware('registred');
    }

    //metoda koja izbacuje view za brisanje svog naloga
    public function deleteAccount(){
        return view('dimitrije/deleteAccount', ['body_id' => 'aboutus_body']);
    }

    //submit za brisanje svog naloga korisnika
    public function deleteAccountSubmit(Request $request){
        $idU = $request->session()->get('IDUser');
        $user = RegistredModel::find($idU);
        if($user != null){    
            if(Auction::isUserBidder($user['IDUser'])) return back()->with('status', "You cannot delete your account while you're the highest bidder at an auction!");
            else if (Auction::isUserOwner($user['IDUser'])) return back()->with('status', "You cannot delete your account while you're the owner of an auction!");
            else if(Exhibition::isUserOwner($user['IDUser'])) return back()->with('status', "You cannot delete your account while you're the owner of an exhibition!");
            
            $adm = AdministratorModel::find($idU);
            if($adm != null){
                $adm->delete();
            }
            $request->session()->flush();
            $user->delete();
            $ret = "Account deletion successful!";
            return redirect('/login')->with('status', $ret);
        }
        return redirect()->route('login');
    }

    //metoda koja izbacuje view za licitiranje za datu auckiju
    public function bidding($idauc) {
        $auction = Auction::find($idauc);
        return view('dimitrije/bidding', ['auction' => $auction]);
    }

    //submit licitacije korisnika za datu aukciju
    public function biddingSubmit($idauc, Request $request){
        $idU = $request->session()->get('IDUser');
        $user = RegistredModel::find($idU);
        $bid = $request['bidInput'];
        $regex = '/^\d{1,10}$/';
        if(!preg_match($regex, $bid)) {
            return back()->with('status', "Bid not in right format!");
        }     
        if(($auction = Auction::find($idauc)) != null){
            if($auction['IsActive'] == 0){
                return back()->with('status', "The auction has finished! You cannot bid anymore.");
            } else {
                //provera ispravnosti unetog bida i da li ima toliko novca na racunu;                
                $max = $auction['Price'];
                $maxBidderId = $auction['HighestBidder'];
                $temp = 0;
                if($idU == $maxBidderId) $temp = $max;
                if($user['Balance'] + $temp < $bid){
                    return back()->with('status', "Your account has insufficient funds for proposed bid.");
                }
                if($bid <= $max){
                    $ret = "Your bid isn't high enough. The highest bidder bid " . $max . "din";
                } else {
                    if ($maxBidderId != null){
                        $maxUser = RegistredModel::find($maxBidderId);
                        $maxUser->Balance += $max;
                        $maxUser->save();
                        // $idbids = BidModel::findBid($maxBidderId, $idauc);
                        // foreach ($idbids as $idbid) {
                        //     $idbid->delete();
                        // }
                    }
                    //$newBid = new BidModel();
                    /*$newBid->IDUser =*/ $auction->HighestBidder = $idU;
                    $user->Balance -= $bid;
                    if($idU == $maxBidderId){
                        $user->Balance+=$max;
                    }
                    // $newBid->IDAuc = $idauc;
                    /* $newBid->Price =*/ $auction->Price = $bid;
                    // $newBid->save();
                    $user->save();
                    $auction->save();                  
                    $ret = "Successfully placed bid.";

                    if (($highestBot = BotModel::findMaxBid($idauc)) != null) {
                        if ($highestBot['IDUser'] == $maxBidderId) BotModel::biddingBots($idauc, $auction, $user, $max);
                    }
                }
                
                return back()->with('status', $ret);
            }           
        }
        return redirect()->route('auctions');
    }

    //metoda koja izbacuje view za postavljanje bota od strane korisnika
    public function biddingBot($idauc) {
        $auction = Auction::find($idauc);
        return view('dimitrije/biddingBot', ['auction' => $auction]);
    }

    //submit koji postavlja bota za korisnika za datu aukciju
    public function biddingBotSetup($idauc, Request $request) {
        $idU = $request->session()->get('IDUser');
        $user = RegistredModel::find($idU);
        $newMaxBid = 0;
        $mybot = $request['bidBotInput'];
        $regex = '/^\d{1,10}$/';
        if(!preg_match($regex, $mybot)) {
            return back()->with('status', "Bid not in right format!");
        }     
        if(($auction = Auction::find($idauc)) != null){
            if($auction['IsActive'] == 0){
                return back()->with('status', "The auction has finished! You cannot bid anymore.");
            } else {
                //provera ispravnosti unetog bida i da li ima toliko novca na racunu;  
                $temp = 0;                                                                      //ako je korisnik max. bidder i hoce da pojaca svoj bid, temp sluzi da
                                                                                                //proveri da li ce imati dovoljno novca kada mu se vrati trenutni max bid
                if (($maxBot = BotModel::findMaxBid($idauc)) != null){
                    if($maxBot['IDUser'] == $idU) $temp = $maxBot['MaxPrice'];
                }
                $max = $auction['Price'];
                $maxBidderId = $auction['HighestBidder'];
                if ($maxBidderId != null) $maxUser = RegistredModel::find($maxBidderId);                
                if($idU == $maxBidderId && $max > $temp) $temp = $max;
                if($user['Balance'] + $temp < $mybot){
                    return back()->with('status', "Your account has insufficient funds for proposed maximum bid.");
                }

               
                if($mybot <= $max){
                    return back()->with('status', "Your maximum bid isn't high enough. The current bid is " . $max . "din");
                }
                $temp = 0;
                if ($maxBot != null){
                    $temp = $maxBot['MaxPrice'];
                }
                $moneyToReturn =  ($temp > $max) ? $temp : $max;            //novac koji treba da se vrati trenutnom korisniku sa najvecim bidom/botom

                if ($maxBot != null){                    
                    if($mybot <= $maxBot['MaxPrice']){
                        return back()->with('status', "Your maximum bid isn't high enough. The highest maximum bid is " . $maxBot['MaxPrice'] . "din");
                    } else {    //korisnikov bot moze da ide dalje od trenutnog maksimalnog bota                                                                       
                        $maxBot->IDUser = $user['IDUser'];
                        $maxBot->MaxPrice = $mybot;
                        $maxBot->save();
                    }                    
                } else {        //nema botova za datu aukciju tako da pravimo novog
                    $newBot = new BotModel();
                    $newBot->IDUser = $user['IDUser'];
                    $newBot->IDAuc = $idauc;
                    $newBot->MaxPrice = $mybot;
                    $newBot->save();
                }           //tabela bot je gotova, sad je na redu auction
                $newMaxBid = ($mybot < $moneyToReturn + 10) ? $mybot : $moneyToReturn + 10;
                $auction->HighestBidder = $idU;
                $a = $mybot;
                $user->save();
                if($maxBidderId != null){
                    if ($maxBidderId == $idU) {
                        $a -= $moneyToReturn;
                    } else {
                        $maxUser->Balance+=$moneyToReturn;
                        $maxUser->save();
                    }
                }
                $user->Balance -= $a;
                $user->save();
                $auction->Price = $newMaxBid;
                $auction->save();
                return back()->with('status', "Successfully set up bot on auction.");
            }
        }       
        return redirect()->route('auctions');
    }
}


