<?php

namespace App\Http\Requests;

use App\Models\Inventory;
use App\Rules\InventoryOrderItemQuantityConfirm;
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

                if (! $inventoryArchive && $inventoryItem->quantity < $value) {
                    $fail("There are $inventoryItem->quantity of inventory item #$inventoryItem->id available. Update quantity, or edit the id.");
                }

                if ($inventoryArchive && $value - $inventoryArchive->quantity_removed > $inventoryItem->quantity) {
                    $fail("There are $inventoryItem->quantity of inventory item #$inventoryItem->id available to add to item. Update quantity, or edit the id.");
                }
            }],
            'reason_removed' => 'nullable|string|max:255',
            'confirm_quantity' => new InventoryOrderItemQuantityConfirm($this->inventory_archive),
        ];
    }
}
