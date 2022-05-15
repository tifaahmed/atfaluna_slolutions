<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailable;

use Mail;
class Mails extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $pin;

    public function __construct($pin)
    {
        $this->pin = $pin;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('atfaluna.solution@gmail.com','email_title')
                    ->subject('email_subject_title')
                    ->view('mails.clint-forgot-password');
    }
}
