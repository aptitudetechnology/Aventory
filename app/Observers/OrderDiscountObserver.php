<?php

namespace App\Observers;

use App\Models\OrderDiscount;

class OrderDiscountObserver
{
    /**
     * Handle the order discount "created" event.
     *
     * @param  \App\Models\OrderDiscount $orderDiscount
     * @return void
     */
    public function created(OrderDiscount $orderDiscount)
    {
        $this->updateTotals($orderDiscount);
    }

    /**
     * Handle the order discount "updated" event.
     *
     * @param  \App\Models\OrderDiscount $orderDiscount
     * @return void
     */
    public function updated(OrderDiscount $orderDiscount)
    {
        $this->updateTotals($orderDiscount);
    }

    protected function updateTotals(OrderDiscount $orderDiscount)
    {
        $orderDiscount->sale->updateTotals();
    }
}
