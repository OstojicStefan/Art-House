<?php

namespace App\Mail;

use App\Models\nikola\Exhibition;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MyExhibitionInfoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $exhibition;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($exhibition)
    {
        $this->exhibition = $exhibition;
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $flag_donation = $this->exhibition->FlagDonations;
        $donations = $this->exhibition->AccumulatedDonations;


        return $this->markdown('emails.my_exhibition_info', ['exhibition_name' => $this->exhibition->Name, 'donations' => $donations, 'flag_donations' => $flag_donation, 'rating' => $this->exhibition->Rating, 'rating_count' => $this->exhibition->RatingCount])
            ->subject('Your exhibition was successfully held!');
    }
}
