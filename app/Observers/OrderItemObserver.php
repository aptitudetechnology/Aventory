<?php

namespace App\Observers;

use App\Models\OrderItem;

class OrderItemObserver
{
    public function saved(OrderItem $orderItem)
    {
        $orderItem->sale->updateTotals();
    }

    public function deleting(OrderItem $orderItem)
    {
        // Need to use ->each as this will make the modal deleted event fire, 
        // which updates the inventory through the archive inventory observer.
        $orderItem->archived->each->delete();
    }

    public function deleted(OrderItem $orderItem)
    {
        $orderItem->sale->updateTotals();
    }
}
