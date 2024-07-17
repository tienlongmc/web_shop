<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $customer;
    public $orders;
    public function __construct( $orders,$customer)
    {
        //
        $this->customer = $customer;
        $this->orders = $orders;
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->view('mail.send1') ->with([
            'customer' => $this->customer,
            'orders' => $this->orders,
        ]);
    }
}
