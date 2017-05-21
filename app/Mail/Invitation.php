<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Guest;

class Invitation extends Mailable
{
    use Queueable, SerializesModels;

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
        $guest = $this->guest;
        $data = [
            'logoImageUrl' => asset('imgs/email-logo.jpg'),
            'headerColor' => '#262E30',
            'title' => '',
            'mainBodyColor' => '#262E30',
            'mainMessage' => '',
            'heroPictureUrl' => asset('imgs/invitation.jpg'),
            'heroPictureAltText' => 'hao and mia',
            'ctaTitle' => "Hello $guest->honorific $guest->first_name $guest->last_name,",
            'ctaTextColor' => '#F7ECB4',
            'ctaMessage' => "We are so excited to invite you to our wedding on July 8th at Prairie Productions! Please let us know if you can make it by following your personalized link below.",
            'actionUrl' => 'http://localhost:1313/#rsvp?code=' . $guest->addressee_code,
            'actionText' => 'RSVP Now',
            'actionBackgroundColor' => '#F7ECB4',
            'actionTextColor' => '#262E30',
            'postMessage' => '<br> Here are the details for the wedding again: <br><br> July 8, 2017 at 4pm <br> Prairie Productions 1314 W Randolph St. Chicago, IL'];

        return $this->view('layouts.heroEmail')->with($data);
    }
}
