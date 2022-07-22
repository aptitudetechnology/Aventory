<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;


/**
 * App\Models\Order
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
 * @property-read \App\Models\DeliveryStatus|null $deliveryStatus
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderDiscount[] $discounts
 * @property-read int|null $discounts_count
 * @property-read mixed $discount_percentage
 * @property-read string $full_name
 * @property-read string $name
 * @property-read mixed $ready_to_complete
 * @property-read mixed $route
 * @property-read mixed $shipping_tax_amount
 * @property-read mixed $tax_rate
 * @property-read mixed $total_of_items_with_discount
 * @property-read mixed $type
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderItem[] $items
 * @property-read int|null $items_count
 * @property-read \App\Models\PaymentStatus|null $paymentStatus
 * @property-read \App\Models\Quote|null $quote
 * @property-read \Illuminate\Database\Eloquent\Collection|Order[] $relatedOrders
 * @property-read int|null $related_orders_count
 * @property-write mixed $warranty_ammount
 * @property-read \App\Models\Team $team
 * @property-read \App\Models\User|null $teamMember
 * @method static \Database\Factories\OrderFactory factory(...$parameters)
 * @method static Builder|Order newModelQuery()
 * @method static Builder|Order newQuery()
 * @method static Builder|Order query()
 * @method static Builder|Order whereAddedToQb($value)
 * @method static Builder|Order whereCompleted($value)
 * @method static Builder|Order whereContactId($value)
 * @method static Builder|Order whereCreatedAt($value)
 * @method static Builder|Order whereCustomerId($value)
 * @method static Builder|Order whereDate($value)
 * @method static Builder|Order whereDeliveryStatusId($value)
 * @method static Builder|Order whereFromQuoteId($value)
 * @method static Builder|Order whereGrandTotal($value)
 * @method static Builder|Order whereHoldInventory($value)
 * @method static Builder|Order whereId($value)
 * @method static Builder|Order whereIsQuote($value)
 * @method static Builder|Order whereIsTaxable($value)
 * @method static Builder|Order whereNotes($value)
 * @method static Builder|Order wherePaymentStatusId($value)
 * @method static Builder|Order whereQbId($value)
 * @method static Builder|Order whereQuoteExpires($value)
 * @method static Builder|Order whereShippingAmount($value)
 * @method static Builder|Order whereShippingMethodId($value)
 * @method static Builder|Order whereTaxAmount($value)
 * @method static Builder|Order whereTaxPercentage($value)
 * @method static Builder|Order whereTeamId($value)
 * @method static Builder|Order whereTeamMemberId($value)
 * @method static Builder|Order whereTotal($value)
 * @method static Builder|Order whereTotalAfterDiscountAndWarranty($value)
 * @method static Builder|Order whereTotalDiscounts($value)
 * @method static Builder|Order whereUpdatedAt($value)
 * @method static Builder|Order whereWarrantyAmount($value)
 * @method static Builder|Order whereWarrantyPercentage($value)
 * @mixin \Eloquent
 */
class Order extends Sale
{
    use HasFactory;
    protected $with = ['customer', 'teamMember', 'deliveryStatus', 'paymentStatus'];

    protected $attributes = [
        'is_quote' => false,
    ];


    protected static function booted()
    {
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->where('is_quote', false);
        });
    }

    public function paymentStatus()
    {
        return $this->belongsTo(PaymentStatus::class);
    }

    public function deliveryStatus()
    {
        return $this->belongsTo(DeliveryStatus::class);
    }

    public function quote()
    {
        return $this->belongsTo(Quote::class, 'from_quote_id');
    }

    public function relatedOrders()
    {
        return $this->hasMany(Order::class, 'from_quote_id', 'from_quote_id')->where('id', '!=', $this->id);
    }
}
