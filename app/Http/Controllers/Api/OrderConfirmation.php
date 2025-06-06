<?php
namespace App\Mail;

use Illuminate\Mail\Mailable;
use App\Models\Order;

class OrderConfirmation extends Mailable
{
    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function build()
    {
        return $this->view('emails.order_confirmation')
            ->with(['order' => $this->order])
            ->subject('Conferma Ordine');
    }
}
