<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BlogSubmittedMail extends Mailable
{
    use SerializesModels;

    public $blog;

    public function __construct($blog)
    {
        $this->blog = $blog;
    }

    public function build()
    {
        return $this->subject('Your Blog Has Been Submitted')
                    ->view('emails.blog-submitted');
    }
}