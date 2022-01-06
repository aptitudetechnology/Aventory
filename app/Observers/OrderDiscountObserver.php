<?php

namespace App\Observers;

use App\Models\OrderDiscount;

class OrderDiscountObserver
{
    /**
     * Handle the order discount "created" event.
     *
     * @param  \App\OrderDiscount  $orderDiscount
     * @return void
     */
    public function created(OrderDiscount $orderDiscount)
    {
        $orderDiscount->order->updateTotals();
    }

    /**
     * Handle the order discount "updated" event.
     *
     * @param  \App\OrderDiscount  $orderDiscount
     * @return void
     */
    public function updated(OrderDiscount $orderDiscount)
    {
        $orderDiscount->order->updateTotals();
    }
}
