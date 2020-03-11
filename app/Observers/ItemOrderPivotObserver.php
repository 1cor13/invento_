<?php

namespace App\Observers;

use App\ItemOrderPivot;

class ItemOrderPivotObserver {
    public function creating(ItemOrderPivot $itemOrderPivot) {
        dump($itemOrderPivot);
        Log::info('This is some useful information.', $itemOrderPivot);
        error_log('Some message here.');
    }
}
