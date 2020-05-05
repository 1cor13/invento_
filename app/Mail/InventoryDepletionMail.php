<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Item;
use App\User;

class InventoryDepletionMail extends Mailable
{
    use Queueable, SerializesModels;
    public $item;
    public $manager;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    
    public function __construct(Item $item, User $manager)
    {
        $this->item = $item;
        $this->manager = $manager;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.inventory-depletion');
    }
}
