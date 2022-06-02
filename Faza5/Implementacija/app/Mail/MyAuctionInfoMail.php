<?php

namespace App\Mail;

use App\Models\nikola\Registred;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MyAuctionInfoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $auction;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($auction)
    {
        $this->auction = $auction;
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $buyer = Registred::find($this->auction->HighestBidder);
        if (empty($buyer)) {
            return $this->markdown('emails.my_auction_info', ['auction' => $this->auction])
                ->subject('Your auction was successfully held!');
        }
        return $this->markdown('emails.my_auction_info', ['auction' => $this->auction, 'buyer' => $buyer])
            ->subject('Your auction was successfully held!');
    }
}
