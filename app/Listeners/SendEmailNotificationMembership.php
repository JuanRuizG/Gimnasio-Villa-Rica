<?php

namespace App\Listeners;

use App\Events\ClientWasRegister;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\NotificationsMembership\MembershipClient;

class SendEmailNotificationMembership
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ClientWasRegister  $event
     * @return void
     */
    public function handle(ClientWasRegister $event)
    {
        $client = $event->client;
        $pdf = $event->pdf;

        if (!is_null($client->email))
        {
            Mail::to($client->email)->send(new MembershipClient($client,$pdf->output()));
        }

    }
}
