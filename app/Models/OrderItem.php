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

    protected $appends = ['product_name', 'size_name', 'line_total', 'line_discount', 'line_total_after_discount'];

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

    public function inventory()
    {
        return $this->belongsToMany(Inventory::class, 'inventory_archive', 'order_item_id', 'inventory_id')
            ->as('archive')
            ->withPivot('quantity_removed', 'removed_by_id', 'reason_removed');
    }

    public function archived()
    {
        return $this->hasMany(InventoryArchive::class);
    }


    public function getIsMatchedAttribute()
    {
        return $this->matched_quantity >= $this->quantity;
    }

    public function getUnmatchedQuantityAttribute()
    {
        return $this->quantity - $this->matched_quantity;
    }

    public function getMatchedQuantityAttribute()
    {
        return $this->inventory->sum('archive.quantity_removed');
    }

    public function getLineTotalAttribute()
    {
        return $this->quantity * $this->unit_price;
    }
    public function getLineDiscountAttribute()
    {
        return $this->no_discount ? 0 : $this->line_total * ($this->order->discount_percentage / 100);
    }

    public function getLineTotalAfterDiscountAttribute()
    {
        return $this->line_total - $this->line_discount;
    }

    public function getTaxAmountAttribute()
    {
        if ($this->product->is_taxable && $this->order->is_taxable) {
            return $this->line_total_after_discount * $this->order->tax_percentage / 100;
        } else {
            return 0;
        }
    }
}
