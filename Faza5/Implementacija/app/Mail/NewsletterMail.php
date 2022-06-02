<?php

namespace App\Mail;

use App\Models\nikola\Auction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewsletterMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $auctions = new Auction();
        $auctions = $auctions->orderBy('ViewCount', 'desc')->take(3)->get();


        return $this->markdown('emails.newsletter', ['auctions' => $auctions])
            ->subject('Most popular auctions for today');
    }
}
