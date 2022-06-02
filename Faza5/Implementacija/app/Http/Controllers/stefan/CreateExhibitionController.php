<?php

// Autor: Stefan Ostojic, 18/442
// Ovaj kontroler se bavi funkcionalnostima pravljenja izlozbe

namespace App\Http\Controllers\stefan;

use App\Http\Controllers\Controller;
use App\Models\stefan\AllImages;
use App\Models\stefan\AllExhibitions;
use App\Models\stefan\AllImagesOnExhibition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CreateExhibitionController extends Controller
{
    function __construct() {
        $this->middleware('registred');
    }

    // Funkcija koja korisniku dovlaci sve njegove slike pruzajuci mu izbor za svoju izlozbu
    public function createExhibition()
    {  
        $id = Session::get('IDUser');
        $allImages = new AllImages();
        $images = $allImages->findUsersImages($id);

        return view('stefan/createExhibition', ['body_id' => 'aboutus_body'], ['images' => $images]);
    }

    // Funkcija koja obradjuje slike koje je korisnik izabrao za tekucu izlozbu
    public function myExhibition()
    {
        $images=AllImages::all();
        $exhibitions=AllExhibitions::all();
        $imagesOnExhibitions=AllImagesOnExhibition::all();

        return view('stefan/myExhibition', ['body_id' => 'aboutus_body'], ['images' => $images]);
    }


    // Funkcija koja regulise samo slanje zahteva serveru
    public function createExhibitionSubmit(Request $request)
    {
        //dd($request);
        $id = Session::get('IDUser');

        $newExhibition = new AllExhibitions();

        $newExhibition->Name = $request->exhibitionName;
        $newExhibition->ImageNumber = sizeof($request->imageOrder);
        $newExhibition->Song = $request->songChoice;
        if ($request->allowDonations == 'on') {
            $newExhibition->FlagDonations = 1;
        } else {
            $newExhibition->FlagDonations = 0;
        }
        $newExhibition->Date = $request->exhibitionTime;
        $newExhibition->IsActive = 1;
        $newExhibition->IDUser = $id;
        $newExhibition->Rating = 0;
        $newExhibition->save();

        $exhKey=$newExhibition->IDExh;

        $allImages = new AllImages();
        $usersImages=$allImages->findUsersImages($id);
        
        for ($i=0;$i<sizeof($request->imageOrder);$i++){
            $newImageOnExhibition = new AllImagesOnExhibition();
            
            $newImageOnExhibition->IDExh = $exhKey;

            $imageID=$allImages->findImageID($usersImages,$request->imagePic[$i]);
            $newImageOnExhibition->IDIm = $imageID;

            $newImageOnExhibition->Description = $request->imageDesc[$i];

            //Ukoliko redni broj slike u izlozbi nije podesen, dobice najveci moguci broj na izlozbi
            if ($request->imageOrder[$i]) {
            $newImageOnExhibition->OrdinalNumber = $request->imageOrder[$i];
            } else {
                $newImageOnExhibition->OrdinalNumber = sizeof($request->imageOrder);
            }

            $newImageOnExhibition->save();
        }
        return redirect()->route('exhibition', ['id' => $exhKey]);
    }
}
