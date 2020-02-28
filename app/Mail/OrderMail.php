<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;
class OrderMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $cart,$forename;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($cart,$forename,$billing,$delivery)
    {
       $this->cart = $cart;
       $this->forename = $forename;
       $this->billing = $billing;
       $this->delivery = $delivery;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env("FROM_MAIL"),env("APP_NAME"))->view('mail.confirmorder')->markdown('mail.confirmorder')->subject('Order confirmed! -' . Str::random(40))->with(array_merge([
            'array' => ['cart' => $this->cart, 'forename' => $this->forename, 'billing' => $this->billing, 'delivery' =>  $this->delivery]
            ]));
    
    }
}
