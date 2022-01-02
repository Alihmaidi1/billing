<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class invoice extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $invoice;
    public $invoice_details1;
    public function __construct($invoice,$invoice_details1)
    {


        $this->invoice=$invoice;
        $this->invoice_details1=$invoice_details1;
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $invoice=$this->invoice;
        $invoice_details1=$this->invoice_details1;

        return $this->view('billing/email_invoice',compact("invoice","invoice_details1"));
    }
}
