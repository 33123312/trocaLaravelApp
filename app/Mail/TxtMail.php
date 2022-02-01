<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TxtMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $msg;
    public $name;

    public function __construct($usr,$msg){
        $this->name = $usr->nickname;
        $this->msg = $msg;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
    
        return $this->view(
            'mails.TxtMail',
            [
                "name"=>$this->name,
                "msg"=>$this->msg,
            ]
        );

    }
}
