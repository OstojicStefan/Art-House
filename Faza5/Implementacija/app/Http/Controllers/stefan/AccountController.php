<?php

// Stefan Ostojic, 18/442
// Ovaj kontroler se bavi funkcionalnostima vezano za sam nalog korisnika

namespace App\Http\Controllers\stefan;

use App\Http\Controllers\Controller;
use App\Models\bogdan\SviKorisnici;
use App\Models\stefan\AllImages;
use App\Models\stefan\AllAuctions;
use App\Models\stefan\AllExhibitions;
use App\Models\stefan\AllImagesOnExhibition;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    function __construct()
    {
        $this->middleware('registred', ['except' => [
            'indexInit'
        ]]);
    }

    //Funkcija koja vraca korisnikovu stranicu sa svim njegovim podacima
    public function myAccount()
    {
        $id = Session::get('IDUser');
        $allImages = new AllImages();
        $images = $allImages->findUsersImages($id);

        $allAuctions = new AllAuctions();
        $myAuctions = $allAuctions->where('Owner', $id)->orWhere([['HighestBidder', $id], ['IsActive', 0]])->get();

        return view('stefan/myAccount', ['body_id' => 'aboutus_body'], ['images' => $images, 'auctions' => $myAuctions]);
    }

    //Funkcija koja korisniku ucitava settings stranicu gde moze da kontrolise i podesava stvari vezano za svoj nalog
    public function myAccountSettings()
    {
        $id = Session::get('IDUser');
        $users = new SviKorisnici();
        $user = $users->where('IDUser', $id)->get();

        return view('stefan/settings', ['body_id' => 'aboutus_body'], ['user' => $user]);
    }

    //Funkcija koja sluzi da korisnik menja opcije oko primanja odredjenih tipova mejlova
    public function settingsSubmit(Request $request)
    {
        $users = new sviKorisnici();
        $user = $users->where('IDUser', $request->userID)->first();

        $user->FlagHotAuctions = $request->hotAuctions;
        $user->FlagNotifyEnding = $request->notifyEnding;

        $user->save();

        return redirect()->route('settings');
    }

    //Funkcija koja korisniku ucitava index stranicu koja oslikava aktuelna desavanja na sajtu
    public function indexInit()
    {
        $allExhibitions = new AllExhibitions();

        if ($allExhibitions->count() > 3) {

            $mostRecent = AllExhibitions::orderBy('IDExh', 'desc')->take(4)->get();

            $allImagesOnExhibition = new AllImagesOnExhibition();

            $allImages = new AllImages();

            //ovaj deo regulise slanje slika 4 najskorije izlozbe
            for ($i = 0; $i < 4; $i++) {
                $mostRecentImages[$i] = $allImages->findImage($allImagesOnExhibition->findImageOnExhibition($mostRecent[$i]->IDExh)->IDIm);
            }

            $allAuctions = new AllAuctions();

            $mostRecentAuctions = AllAuctions::orderBy('IDAuc', 'desc')->take(4)->get();
        } else {
            $mostRecent = AllExhibitions::orderBy('IDExh', 'desc')->get();
            $mostRecentImages = [];
            $mostRecentAuctions = [];
            $allImages = [];
        }
        return view('stefan/index', ['body_id' => 'index_body'], ['mostRecent' => $mostRecent, 'mostRecentImages' => $mostRecentImages, 'mostRecentAuctions' => $mostRecentAuctions, 'images' => $allImages]);
    }

    //Vraca About Us stranicu
    public function aboutUs()
    {
        return view('stefan/aboutUs', ['body_id' => 'aboutus_body']);
    }
}
