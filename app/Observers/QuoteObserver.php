<?php

namespace App\Observers;

use App\Models\Quote;

class QuoteObserver
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
     * @param Quote $quote
     * @return void
     */
    public function created(Quote $quote)
    {
        $quote->updateTotals();
        $quote->createCustomerDiscount();
    }

    /**
     * When deleting an order, we remove the associated items.
     * 
     * 
     * @param Quote $quote
     * @return void
     */
    public function deleting(Quote $quote)
    {
        $quote->items->each->delete();
    }
}
