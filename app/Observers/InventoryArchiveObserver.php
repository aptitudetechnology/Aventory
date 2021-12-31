<?php

namespace App\Observers;

use App\Models\InventoryArchive;

class InventoryArchiveObserver
{
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
    public function updating(InventoryArchive $inventoryArchive)
    {
        $inventoryArchive->inventory->increment('quantity', intval($inventoryArchive->getOriginal('quantity_removed')));
        $inventoryArchive->inventory->decrement('quantity', intval($inventoryArchive->quantity_removed));
    }

    /**
     * 
     * When deleting an archive, we add the inventory back to inventory.
     * 
     * @param InventoryArchive $inventoryArchive
     * @return void
     */
    public function deleting(InventoryArchive $inventoryArchive)
    {
        $inventoryArchive
            ->inventory
            ->increment(
                'quantity',
                $inventoryArchive->quantity_removed
            );
    }
}
