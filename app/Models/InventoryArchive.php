<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryArchive extends Model
{
    use HasFactory;
    protected $table = 'inventory_archive';
    protected $guarded = [];
    protected $casts = [
        'id' => 'integer',
        'order_item_id' => 'integer',
        'inventory_id' => 'integer',
        'quantity_removed' => 'integer',
        'removed_by_id' => 'integer',
        'reason_removed' => 'string',
        'was_adjustment' => 'boolean',
    ];
    protected $appends = ['product_name', 'size_name'];

    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }

    public function order()
    {
        return $this->hasOneThrough(Order::class, OrderItem::class, 'id', 'id', 'order_item_id', 'order_id');
    }

    public function product()
    {
        return $this->hasOneThrough(Product::class, OrderItem::class, 'id', 'id', 'order_item_id', 'product_id');
    }

    public function getProductNameAttribute()
    {
        return $this->product->name;
    }

    public function size()
    {
        return $this->hasOneThrough(Size::class, OrderItem::class, 'id', 'id', 'order_item_id', 'size_id');
    }

    public function getSizeNameAttribute()
    {
        return $this->size->name;
    }
}
