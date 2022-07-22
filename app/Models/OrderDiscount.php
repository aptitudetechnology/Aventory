<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OrderDiscount
 *
 * @property int $id
 * @property int $order_id
 * @property string $description
 * @property string|null $discount_amount
 * @property int|null $discount_percentage
 * @property bool $discount_applied
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $discount_total
 * @property-read string $discount_type
 * @property-read mixed $is_quote
 * @property-read mixed $sale_type
 * @property-read string $title
 * @property-read \App\Models\Order $order
 * @property-read \App\Models\Quote $quote
 * @property-read \App\Models\Sale $sale
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDiscount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDiscount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDiscount query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDiscount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDiscount whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDiscount whereDiscountAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDiscount whereDiscountApplied($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDiscount whereDiscountPercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDiscount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDiscount whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDiscount whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class OrderDiscount extends Model
{
    use HasFactory;
    protected $table = 'order_discounts';
    protected $guarded = [];
    protected $appends = ['discount_total', 'is_quote', 'sale_type'];

    // $casts
    protected $casts = [
        'discount_applied' => 'boolean',
        'discount_percentage' => 'integer',
        'discount_total' => 'float',
    ];

    public function getSaleTypeAttribute()
    {
        return $this->is_quote ? 'quote' : 'order';
    }

    public function sale()
    {
        return $this->belongsTo(Sale::class, 'order_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function quote()
    {
        return $this->belongsTo(Quote::class, 'order_id');
    }

    public function getIsQuoteAttribute()
    {
        return $this->order ? false : true;
    }

    public function orderOrQuote()
    {
        return $this->order ? $this->order() : $this->quote();
    }

    public function getDiscountTotalAttribute()
    {
        return $this->discount_amount != null
            ? $this->discount_amount
            : $this->orderOrQuote->total_of_items_with_discount * ($this->discount_percentage / 100);
    }

    public function getTitleAttribute(): string
    {
        return $this->discount_percentage ? 'Percentage Discount' : 'Dollar Amount Discount';
    }

    public function getDiscountTypeAttribute(): string
    {
        return $this->discount_percentage ? 'percentage' : 'amount';
    }
}
