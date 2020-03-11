<?php
namespace App\Observers;
use App\Item;
use App\Role;
use App\Mail\InventoryDepletionMail;
use Illuminate\Support\Facades\Mail;

class ItemObserver {
    //eloquent model events: retrieved , creating , created , updating , updated , saving , saved , deleting , deleted , restoring , restored

    public function saved(Item $item) {
        if ($item->quantity <= $item->minimum_quantity && !$item->depleted) {
            $item->depleted = true;
            $item->save();

            // send email to manager
            $managerRole = Role::where('name', 'manager')->first();
            $manager = $managerRole->users->first();

            Mail::to($manager->email)->send(new InventoryDepletionMail(), compact('item'));
        }
    }
}

