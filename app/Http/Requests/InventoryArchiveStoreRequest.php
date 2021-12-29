<?php

namespace App\Http\Requests;

use App\Models\Inventory;
use App\Models\OrderItem;
use Illuminate\Foundation\Http\FormRequest;

class InventoryArchiveStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'inventory_id' => 'required|integer|exists:inventories,id',
            'order_item_id' => 'nullable|integer|exists:order_items,id',
            'quantity_removed' => ['required', 'integer', 'min:1', function ($attribute, $value, $fail) {
                $inventoryItem = Inventory::find($this->inventory_id);
                $inventoryArchive = $this->inventory_archive;

                if (!$inventoryArchive && $inventoryItem->quantity < $value) {
                    $fail("There are $inventoryItem->quantity of inventory item #$inventoryItem->id available. Update quantity, or edit the id.");
                }

                if ($inventoryArchive && $value - $inventoryArchive->quantity_removed > $inventoryItem->quantity) {
                    $fail("There are $inventoryItem->quantity of inventory item #$inventoryItem->id available to add to item. Update quantity, or edit the id.");
                }


                if (
                    $inventoryArchive &&
                    $value > $inventoryArchive->quantity_removed &&
                    $inventoryArchive->orderItem->unmatched_quantity < $value - $inventoryArchive->quantity_removed
                ) {
                    $orderItem = OrderItem::find($this->order_item_id);
                    $quantityAbleToMatch = $orderItem->unmatched_quantity + $inventoryArchive->quantity_removed;
                    $quantityAlreadyMatched = $orderItem->matched_quantity - $inventoryArchive->quantity_removed;
                    $fail("You cannot match more than $quantityAbleToMatch because there are only $orderItem->quantity items in this order line item and $quantityAlreadyMatched are already matched. If you want to adjust the item quantity, edit it in the order.");
                }
            }],
            'reason_removed' => 'nullable|string|max:255',
        ];
    }
}
