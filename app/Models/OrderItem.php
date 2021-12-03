<?php

namespace App\Models;

use App\Casts\Money;
use App\Observers\OrderItemObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $table = 'order_items';
    protected $guarded = [];
    protected $fillable = [
        'order_id',
        'product_id',
        'size_id',
        'quantity',
        'original_quantity',
        'unit_price',
        'no_discount',
    ];
    protected $appends = ['product_name', 'size_name', 'line_total'];
    protected $casts = [
        'product_id' => 'integer',
        'size_id' => 'integer',
        'quantity' => 'integer',
        'unit_price' => 'float',
        'no_discount' => 'boolean',
    ];


    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getProductNameAttribute()
    {
        return $this->product->name;
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    public function getSizeNameAttribute()
    {
        return $this->size->name;
    }

    public function getLineTotalAttribute()
    {
        return $this->quantity * $this->unit_price;
    }

    public function getLineTotalAfterDiscountAttribute()
    {
        if ($this->no_discount) {
            return $this->line_total;
        }
        return $this->line_total * (1 - $this->order->discount_percentage / 100);
    }
}
