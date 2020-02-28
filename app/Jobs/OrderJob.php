<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use \Mail;
use App\Mail\OrderMail;
class OrderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $cart,$total,$email,$forename,$billing,$delivery;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($cart,$total,$email,$forename,$billing,$delivery)
    {
        $this->cart = $cart;
        $this->total = $total;
        $this->email = $email;
        $this->forename = $forename;
        $this->billing = $billing;
        $this->delivery = $delivery;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Send mail to the customer and our order mail to confirm.
       Mail::to($this->email)->bcc(env("ORDER_MAIL"))->send(new OrderMail($this->cart,$this->forename,$this->billing,$this->delivery));
    }
}
