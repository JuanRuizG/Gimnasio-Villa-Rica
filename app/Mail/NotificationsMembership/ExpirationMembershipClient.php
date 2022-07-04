<?php

namespace App\Mail\NotificationsMembership;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ExpirationMembershipClient extends Mailable implements ShouldQueue
{
    public $client;

    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.notifications.expiration-membership')
            ->subject('Membresia Expirada')
            ->cc('cafsaludybelleza@gmail.com');
    }
}
