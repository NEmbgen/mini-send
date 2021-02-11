<?php

namespace App\Mail;

use App\Models\UserMail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContentMail extends Mailable
{
    use Queueable, SerializesModels;

//    private $content = '';

    /**
     * Create a new message instance.
     *
     * @param UserMail $mail
     */
    public function __construct(UserMail $mail)
    {
        $this->from = $mail->sender->email;
        $this->html = $mail->body;
        $this->subject = $mail->subject;
        $this->to = [$mail->to];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.content-mail')
            ->from($this->from)
            ->html($this->html)
            ->text($this->html) // TODO: What is correct here?
            ->to($this->to)
            ->with('body', $this->html)
            ->subject($this->subject);
    }
}
