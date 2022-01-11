<?php

namespace App\Observers;

use App\Models\Sale;

class SaleObserver
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
     * @param Sale $order
     * @return void
     */
    public function created(Sale $order)
    {
        $order->updateTotals();
        $order->createCustomerDiscount();
    }

    /**
     * When deleting an order, we remove the associated items.
     * 
     * 
     * @param Sale $order
     * @return void
     */
    public function deleting(Sale $order)
    {
        $order->items->each->delete();
    }
}
