<?php

namespace Abiodunjames\Prodigypdf\Mailer;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Notifications\Messages\MailMessage;

class SendPDF extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    /**
     * @var string
     */

    public $subject;
    /**
     * @var string
     */
    public $body;
    /**
     * @var string
     */
    public $file;
    /**
     * @var string filename
     */
    public $filename;
    public function __construct($file,$subject,$body)
    {
        $this->$subject=$subject;
        $this->body=$body;
        $this->file =$file;
    }

    public function build()
    {
        return $this->subject($this->subject)
            ->attach($this->file)
            ->text($this->body);
    }


}
