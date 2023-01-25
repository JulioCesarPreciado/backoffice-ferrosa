<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewsletterMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $newsletterData = $this->data;
        return $this->from('no-reply@pgm-apps.com')
            ->view('mail.newsletter.template', compact('newsletterData'))
            ->subject($newsletterData['company_name'] . ' - ' . __($newsletterData['title']) );
    }
}
