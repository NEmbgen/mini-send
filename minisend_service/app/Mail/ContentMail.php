<?php

namespace App\Mail;

use App\Models\UserMail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $userMail;

    /**
     * Create a new message instance.
     *
     * @param UserMail $mail
     */
    public function __construct(UserMail $mail)
    {
        $this->userMail = $mail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.content-mail')
            ->from($this->userMail->sender->email)
            ->text('mails.content-mail_plain')
            ->subject($this->userMail->subject);
    }
}
