<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Guest;

class SaveTheDate extends Mailable
{
    use Queueable, SerializesModels;

    public $guest;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Guest $guest)
    {
        $this->guest = $guest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //logoPictureUrl
        
        //title
        //mainMessage
        //heroPictureUrl
        //heroPictureAltText
        //actionText
        //ctaTitle
        //ctaMessage
        //actionUrl
        //actionText
        return $this->view('emails.saveTheDate');
    }
}
