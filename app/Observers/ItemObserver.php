<?php
namespace App\Observers;
use App\Item;
use App\Mail\InventoryDepletionMail;
use Illuminate\Support\Facades\Mail;

class ItemObserver {
    //eloquent model events: retrieved , creating , created , updating , updated , saving , saved , deleting , deleted , restoring , restored

    public function saved(Item $item) {
        if ($item->quantity <= $item->minimum_quantity && !$item->depleted) {
            $item->depleted = true;

            $managerRole = Role::where('name', 'manager')->first();
            $manager = $managerRole->users->first();

            Mail::to($manager->email)->send(new InventoryDepletionMail(), compact('item'));

            // Mail::send('Html.view', $data, function ($message) {
            //     $message->from('john@johndoe.com', 'John Doe');
            //     $message->sender('john@johndoe.com', 'John Doe');
            //     $message->to('john@johndoe.com', 'John Doe');
            //     $message->cc('john@johndoe.com', 'John Doe');
            //     $message->bcc('john@johndoe.com', 'John Doe');
            //     $message->replyTo('john@johndoe.com', 'John Doe');
            //     $message->subject('Subject');
            //     $message->priority(3);
            //     $message->attach('pathToFile');
            // });

            // send email to manager
        }
    }
}

