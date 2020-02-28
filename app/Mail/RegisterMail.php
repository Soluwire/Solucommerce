<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $name;
    public $appname;
    public function __construct($name)
    {
        $this->name = $name;
        $this->appname =  env("APP_NAME");
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env("FROM_MAIL"),$this->appname)->markdown('mail.register')->subject("Thanks for registering for " . $this->appname)->with('name', $this->name);
    }
}
