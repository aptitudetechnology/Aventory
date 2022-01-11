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
        $order = $orderDiscount->order;
        $quote = $orderDiscount->quote;
        if ($order) {
            $order->updateTotals();
        }
        if ($quote) {
            $quote->updateTotals();
        }
    }
}
