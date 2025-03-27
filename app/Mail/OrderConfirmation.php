<?php

namespace App\Mail;

use App\Models\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;

class OrderConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $isAdmin;
    public $customer;

    public function __construct(Order $order, $isAdmin = false)
    {
        $this->order = $order;
        $this->isAdmin = $isAdmin;
        $this->customer = $order->customer;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Order Confirmation #' . $this->order->order_number,
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.order-confirmation',
            with: [
                'order' => $this->order,
                'customer' => $this->customer,
                'isAdmin' => $this->isAdmin
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
