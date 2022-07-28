<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\Quote
 *
 * @property int $id
 * @property int $customer_id
 * @property int|null $team_member_id
 * @property int $team_id
 * @property int|null $contact_id
 * @property \Illuminate\Support\Carbon $date
 * @property int|null $from_quote_id
 * @property int|null $shipping_method_id
 * @property string|null $shipping_amount
 * @property string|null $warranty_percentage
 * @property float|null $warranty_amount
 * @property float $total_discounts
 * @property string|null $tax_percentage
 * @property float|null $tax_amount
 * @property float $total_after_discount_and_warranty
 * @property float $total
 * @property float $grand_total
 * @property bool $is_taxable
 * @property bool $completed
 * @property bool $is_quote
 * @property \Illuminate\Support\Carbon|null $quote_expires
 * @property bool $hold_inventory
 * @property string|null $notes
 * @property bool $added_to_qb
 * @property string|null $qb_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $payment_status_id
 * @property int|null $delivery_status_id
 * @property-read \App\Models\Contact|null $contact
 * @property-read \App\Models\Customer $customer
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderDiscount[] $discounts
 * @property-read int|null $discounts_count
 * @property-read mixed $discount_percentage
 * @property-read string $full_name
 * @property-read string $name
 * @property-read mixed $ready_to_complete
 * @property-read mixed $route
 * @property-read mixed $shipping_tax_amount
 * @property-read mixed $status
 * @property-read mixed $tax_rate
 * @property-read mixed $total_of_items_with_discount
 * @property-read mixed $type
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderItem[] $items
 * @property-read int|null $items_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @property-read int|null $orders_count
 * @property-write mixed $warranty_ammount
 * @property-read \App\Models\Team $team
 * @property-read \App\Models\User|null $teamMember
 *
 * @method static \Database\Factories\QuoteFactory factory(...$parameters)
 * @method static Builder|Quote newModelQuery()
 * @method static Builder|Quote newQuery()
 * @method static Builder|Quote query()
 * @method static Builder|Quote whereAddedToQb($value)
 * @method static Builder|Quote whereCompleted($value)
 * @method static Builder|Quote whereContactId($value)
 * @method static Builder|Quote whereCreatedAt($value)
 * @method static Builder|Quote whereCustomerId($value)
 * @method static Builder|Quote whereDate($value)
 * @method static Builder|Quote whereDeliveryStatusId($value)
 * @method static Builder|Quote whereFromQuoteId($value)
 * @method static Builder|Quote whereGrandTotal($value)
 * @method static Builder|Quote whereHoldInventory($value)
 * @method static Builder|Quote whereId($value)
 * @method static Builder|Quote whereIsQuote($value)
 * @method static Builder|Quote whereIsTaxable($value)
 * @method static Builder|Quote whereNotes($value)
 * @method static Builder|Quote wherePaymentStatusId($value)
 * @method static Builder|Quote whereQbId($value)
 * @method static Builder|Quote whereQuoteExpires($value)
 * @method static Builder|Quote whereShippingAmount($value)
 * @method static Builder|Quote whereShippingMethodId($value)
 * @method static Builder|Quote whereTaxAmount($value)
 * @method static Builder|Quote whereTaxPercentage($value)
 * @method static Builder|Quote whereTeamId($value)
 * @method static Builder|Quote whereTeamMemberId($value)
 * @method static Builder|Quote whereTotal($value)
 * @method static Builder|Quote whereTotalAfterDiscountAndWarranty($value)
 * @method static Builder|Quote whereTotalDiscounts($value)
 * @method static Builder|Quote whereUpdatedAt($value)
 * @method static Builder|Quote whereWarrantyAmount($value)
 * @method static Builder|Quote whereWarrantyPercentage($value)
 * @mixin \Eloquent
 */
class Quote extends Sale
{
    protected $attributes = [
        'is_quote' => true,
    ];

    protected $appends = ['total_of_items_with_discount', 'type', 'name', 'full_name', 'route', 'status'];

    protected static function booted()
    {
        static::addGlobalScope('quote', function (Builder $builder) {
            $builder->where('is_quote', true);
        });
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'from_quote_id');
    }

    public function getStatusAttribute()
    {
        if ($this->isFullfilled()) {
            return 'Fulfilled';
        } elseif ($this->isPartiallyFullfilled()) {
            return 'Partially Fulfilled';
        } elseif ($this->isExpired()) {
            return 'Expired';
        } else {
            return 'Pending';
        }
    }

    public function isFullfilled()
    {
        return $this->items->every(function ($item) {
            return $item->quantity_fulfilled >= $item->quantity;
        });
    }

    public function isPartiallyFullfilled()
    {
        return $this->orders->count() > 0;
    }

    public function isExpired()
    {
        return $this->quote_expires < now();
    }
}
