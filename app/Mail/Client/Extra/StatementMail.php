<?php

namespace App\Mail\Client\Extra;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StatementMail extends Mailable
{
    use Queueable, SerializesModels;

    public $collaborator;


    public function __construct($collaborator)
    {
        $this->collaborator = $collaborator;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no-reply@cmatik.cl', 'CMATIK - DBS')
            ->subject('Declaración Jurada COVID-19')
            ->view('emails.client.extra.statement')
            ->with([
                'worker' => $this->collaborator,
            ]);
    }
}
