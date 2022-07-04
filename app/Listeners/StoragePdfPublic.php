<?php

namespace App\Listeners;

use App\Events\ClientWasRegister;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Carbon\Carbon;

class StoragePdfPublic
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
        $pdf = $event->pdf->output();
        $client = $event->client;
        $date = Carbon::now()->toDateString();
        $name_file = "archivo-{$client->name}-{$date}.pdf";

        Storage::disk('public')->put($name_file,$pdf);
        // Storage::disk('public')->put("archivo-{$client->name}.pdf",$pdf);
    }
}
