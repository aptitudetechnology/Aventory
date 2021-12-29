<?php

namespace App\Observers;

use App\Models\InventoryArchive;

class InventoryArchiveObserver
{
    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    public $afterCommit = true;
    /**
     * When creating an inventory archive, update the inventory quantity.
     *
     * @param InventoryArchive $inventoryArchive
     * @return void
     */
    public function created(InventoryArchive $inventoryArchive)
    {
        $inventoryArchive->inventory->decrement('quantity', intval($inventoryArchive->quantity_removed));
    }

    /**
     * When Updating an Inventory Archive, update the Inventory.
     *
     * @param InventoryArchive $inventoryArchive
     * @return void
     */
    public function updated(InventoryArchive $inventoryArchive)
    {
        $quantityRemovedBefore = intval($inventoryArchive->getOriginal('quantity_removed'));
        $quantityRemovedAfter = intval($inventoryArchive->quantity_removed);
        $inventoryArchive->inventory->increment('quantity', $quantityRemovedBefore - $quantityRemovedAfter);
    }
    /**
     * 
     * When deleting an archive, we add the inventory back to inventory.
     * 
     * @param InventoryArchive $inventoryArchive
     * @return void
     */
    public function deleted(InventoryArchive $inventoryArchive)
    {
        $inventoryArchive
            ->inventory
            ->update([
                'quantity' => $inventoryArchive->inventory->quantity + $inventoryArchive->quantity_removed,
            ]);
    }
}
