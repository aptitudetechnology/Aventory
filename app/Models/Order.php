<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;
    protected $with = ['customer', 'teamMember', 'deliveryStatus', 'paymentStatus'];
    protected $appends = ['total_of_items_with_discount'];
    protected $table = 'orders';
    protected $guarded = [];

    protected $attributes = [
        'is_quote' => false,
    ];


    protected static function booted()
    {
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->where('is_quote', false);
        });
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'date' => 'date:Y-m-d',
        'quote_expires' => 'date:Y-m-d',
        'customer_id' => 'integer',
        'contact_id' => 'integer',
        'team_member_id' => 'integer',
        'team_id' => 'integer',
        'delivery_status_id' => 'integer',
        'payment_status_id' => 'integer',
        'quote_id' => 'integer',
        'is_taxable' => 'boolean',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function teamMember()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the customer that owns the order.
     * Need to add for foreign key since the quote model is an extension of the order model.
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    /**
     * Get the discounts for the order.
     * Need to add for foreign key since the quote model is an extension of the order model.
     */
    public function discounts()
    {
        return $this->hasMany(OrderDiscount::class, 'order_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class);
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

    public function getDiscountPercentageAttribute()
    {
        return $this->discounts->sum('percentage');
    }

    public function getTotalOfItemsWithDiscountAttribute()
    {
        return $this->items()->where('no_discount', false)->sum(DB::raw('quantity * unit_price'));
    }

    public function setTotalAttribute()
    {
        $this->attributes['total'] =
            $this->items->reduce(function ($total, $item) {
                return $total + ($item->line_total);
            }, 0);
    }

    public function setTotalDiscountsAttribute()
    {
        $this->attributes['total_discounts'] =
            $this->discounts()->where('discount_applied', true)->get()->reduce(function ($total, $item) {
                return $total + ($item->discount_total);
            }, 0);
    }

    public function setWarrantyAmmountAttribute()
    {
        $this->attributes['warranty_amount'] = ($this->warranty_percentage / 100) * $this->total;
    }

    public function setTotalAfterDiscountAndWarrantyAttribute()
    {
        $this->attributes['total_after_discount_and_warranty'] = $this->total - $this->total_discounts + $this->warranty_amount;
    }

    public function setTaxAmountAttribute()
    {
        $this->attributes['tax_amount'] = $this->is_taxable ? $this->items->reduce(function ($total, $item) {
            return $total + ($item->tax_amount);
        }, 0) + $this->shipping_tax_amount : 0;
    }

    public function getShippingTaxAmountAttribute()
    {
        return ($this->tax_percentage / 100) * $this->shipping_amount;
    }

    public function setGrandTotalAttribute()
    {
        $this->attributes['grand_total'] = $this->total_after_discount_and_warranty + $this->tax_amount + $this->shipping_amount;
    }

    public function setTaxPercentage()
    {
        $this->attributes['tax_percentage'] = $this->customer->tax_percentage;
        $this->save();
    }

    public function updateTotals()
    {
        $this->setTotalAttribute();
        $this->setWarrantyAmmountAttribute();
        $this->setTotalDiscountsAttribute();
        $this->setTotalAfterDiscountAndWarrantyAttribute();
        $this->setTaxAmountAttribute();
        $this->setGrandTotalAttribute();
        $this->save();
    }

    public function createCustomerDiscount()
    {
        $order = $this->fresh('customer');
        if ($order->customer->discount_percentage) {
            $order->discounts()->create([
                'description' => "Discount of {$order->customer->discount_percentage}% will be applied to eligible products if paid within invoice terms.",
                'discount_percentage' => $order->customer->discount_percentage,
            ]);
        }
    }

    public function updateDiscounts()
    {
        if ($this->wasChanged('customer_id')) {
            $this->discounts()->delete();
            $this->createCustomerDiscount();
        }
    }
}
