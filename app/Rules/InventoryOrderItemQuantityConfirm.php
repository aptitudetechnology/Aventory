<?php

namespace App\Rules;

use App\Models\InventoryArchive;
use App\Models\OrderItem;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ImplicitRule;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\ValidatorAwareRule;

class InventoryOrderItemQuantityConfirm implements Rule, ValidatorAwareRule, ImplicitRule, DataAwareRule
{
    /**
     * The validator instance.
     *
     * @var \Illuminate\Validation\Validator
     */
    protected $validator;

    /**
     * All of the data under validation.
     *
     * @var array
     */
    protected $data = [];

    protected $inventoryArchive;

    protected $orderItem;

    protected $quantityRemoved;

    protected $differenceRemoved;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(InventoryArchive $inventoryArchive = null)
    {
        $this->inventoryArchive = $inventoryArchive;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $orderItem = $this->orderItem;
        $difference_removed = $this->differenceRemoved;

        if (
            $orderItem &&
            $orderItem->unmatched_quantity < $difference_removed
        ) {
            if ($value == false || ! $value) {
                return false;
            } else {
                return true;
            }
        } else {
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        $orderItem = $this->orderItem;
        $increasedQuantity = $orderItem->quantity + $this->differenceRemoved;

        return "You must confirm that you want to increase the quantity of this order item from $orderItem->quantity to $increasedQuantity.";
    }

    /**
     * Set the current validator.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return $this
     */
    public function setValidator($validator)
    {
        $this->validator = $validator;

        return $this;
    }

    /**
     * Set the data under validation.
     *
     * @param  array  $data
     * @return $this
     */
    public function setData($data)
    {
        $this->data = $data;
        $this->quantityRemoved = $data['quantity_removed'];
        $this->orderItem = OrderItem::find($data['order_item_id']);
        $inventoryArchive = $this->inventoryArchive;
        $newQuantityRemoved = $this->quantityRemoved;
        $this->differenceRemoved = $newQuantityRemoved - ($inventoryArchive ? $inventoryArchive->quantity_removed : 0);

        return $this;
    }
}
