<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDiscount extends Model
{
    use HasFactory;
    protected $table = 'order_discounts';
    protected $guarded = [];
    protected $appends = ['discount_total', 'is_quote'];

    // $casts
    protected $casts = [
        'discount_applied' => 'boolean',
        'discount_percentage' => 'integer',
        'discount_total' => 'float',
    ];
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
