<?php

namespace App\Observers;

use App\ItemOrderPivot;
use App\User;
use App\Item;
use App\Order;
use App\Role;
use Illuminate\Support\Facades\Mail;
use App\Mail\InventoryDepletionMail;

class ItemOrderPivotObserver {
    public function creating(ItemOrderPivot $itemOrder) {
        dump("===== ItemOrderPivot Observer creating =====");
        $item = $itemOrder->item;
        $order = $itemOrder->order;
        $newQuantity = $item->quantity - $itemOrder->quantity;
        dump("old quantity: {$item->quantity}, minus: {$itemOrder->quantity}");
        
        if ($newQuantity >= 0) {
            $item->quantity = $newQuantity;
            $item->depleted = $newQuantity <= 0 || $newQuantity <= $item->minimum_quantity;
            $order->subtotal += ($itemOrder->quantity * $item->price);
            dump("======= testing =======");
            if ($item->depleted) {
                // send email to manager
                // $managerRole = Role::where('name', 'manager')->first() ?? Role::create(['name'=>'manager']);
                // $manager = $managerRole->user->first();

                // Mail::to($manager->email)->send(new InventoryDepletionMail(), compact('item'));
                dump("======= SENDING MAIL ======");
                // Mail::to($manager->email)->send(new InventoryDepletionMail(), compact('item'));
            }
        } else {
            // cancel this update to the order, and notify on ui
            return false;
        }
    }

    public function reduceInventory(ItemOrderPivot $itemOrder) {
        $item = $itemOrder->item;
        $order = $itemOrder->order;
        $newQuantity = $item->quantity - $itemOrder->quantity;
        if ($itemOrder->quantity <= $item->quantity && !$item->depleted) {
            $item->depleted = true;
            $item->save();
        }

    }
    public function saved(ItemOrderPivot $itemOrder) {
        dump("new Quantity after saving {$itemOrder->item->quantity}");
    }
}