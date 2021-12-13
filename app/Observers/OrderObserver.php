<?php

namespace App\Observers;

use App\Models\Order;

class OrderObserver
{
    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    public $afterCommit = true;

    /**
     * When creating an order, we add the discount to the order
     * 
     * @param Order $order
     * @return void
     */
    public function created(Order $order)
    {
        $order->updateTotals();
        $order->createDiscount();
    }

    /**
     * When updating an order, we update the discount if the customer is changed.
     * We also need to remove the old discounts if the customer is changed.
     * 
     * @param Order $order
     * @return void
     */
    public function updated(Order $order)
    {
    }
}
