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
            'logoImageAltText' => 'Our Families Would Like to Invite You to...',
            'headerColor' => '#262E30',
            'title' => '',
            'mainBodyColor' => '#262E30',
            'mainMessage' => '',
            'heroPictureUrl' => asset('imgs/invitation.jpg'),
            'heroPictureAltText' => 'Come Join Us For The Wedding of Mia and Hao - July 8th 2017 at 4PM - Prairie Productions 1314 W Randolph St Chicago IL - Dinner and Dancing to Follow',
            'ctaTitle' => "Hello $guest->honorific $guest->first_name $guest->last_name,",
            'ctaTextColor' => '#F7ECB4',
            'ctaMessage' => "We are so excited to invite you to our wedding on July 8th at Prairie Productions! Please let us know if you can make it by following your personalized link below.",
            'actionUrl' => 'http://localhost:1313/#rsvp?code=' . $guest->addressee_code,
            'actionText' => 'RSVP Now',
            'actionBackgroundColor' => '#F7ECB4',
            'actionTextColor' => '#262E30',
            'postMessage' => "<br> Your invite code is <code>$guest->addressee_code</code> (but it should populate automatically when you click the button)<br><br> Feel free to check out our website for more information: <a styles='color: #F7ECB4 !important;' href='https://haoandmia.com'><strong style='font-weight:normal;'>haoandmia.com</strong></a>"];
        
        return $this->subject('Mia and Hao Wedding Invitation')->view('layouts.heroEmail')->text('layouts.plainEmail')->with($data);
    }
}
