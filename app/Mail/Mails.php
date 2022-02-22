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
    public $entry;

    public function __construct($entry)
    {
        $this->entry = $entry;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {


        return $this->from('tifa.ahmed23@gmail.com','email_title')
                    ->subject('email_subject_title')
                    ->view('mails.conversation');
    }
}
