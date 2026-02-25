<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BlogRevokedMail extends Mailable
{
    use SerializesModels;

    public $blog;
    public $reason;

    public function __construct($blog, $reason)
    {
        $this->blog = $blog;
        $this->reason = $reason;
    }

    public function build()
    {
        return $this->subject('Your Blog Has Been Revoked')
                    ->view('emails.blog-revoked');
    }
}