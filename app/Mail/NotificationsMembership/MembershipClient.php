<?php

namespace App\Mail\NotificationsMembership;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MembershipClient extends Mailable
{
    public $client;
    public $pdf_file;

    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($client,$pdf_file)
    {
        $this->client = $client;
        $this->pdf_file = $pdf_file;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Membresia')
            ->view('emails.notifications.membership')
            ->cc('cafsaludybelleza@gmail.com')
            ->attachData($this->pdf_file,'membresia.pdf',[
                'mime' => 'application/pdf',
            ]);
    }
}
