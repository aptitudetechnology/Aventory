<?php

namespace App\Observers;

use App\Models\OrderItem;

class OrderItemObserver
{
    public function saved(OrderItem $orderItem)
    {
        $orderItem->order->updateTotals();
    }

    public function deleted(OrderItem $orderItem)
    {
        $orderItem->order->updateTotals();
    }
}
