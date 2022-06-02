<?php

namespace App\Http\Controllers\nikola;

use App\Http\Controllers\Controller;
use App\Mail\MyAuctionInfoMail;
use App\Mail\MyExhibitionInfoMail;
use App\Mail\NewsletterMail;
use App\Models\nikola\Auction;
use App\Models\nikola\Exhibition;
use App\Models\nikola\Registred;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendNewsletter($IDUser)
    {
        $user = Registred::find($IDUser);
        Mail::to($user->E_mail)->send(new NewsletterMail());
    }

    public function sendExhibitionInfo($IDExh)
    {
        $exhibition = Exhibition::find($IDExh);
        $organizer = Registred::find($exhibition->IDUser);
        Mail::to($organizer->E_mail)->send(new MyExhibitionInfoMail($exhibition));
    }

    public function sendAuctionInfo($IDAuc)
    {
        $auction = Auction::find($IDAuc);
        $owner = Registred::find($auction->Owner);
        Mail::to($owner->E_mail)->send(new MyAuctionInfoMail($auction));
    }
}
