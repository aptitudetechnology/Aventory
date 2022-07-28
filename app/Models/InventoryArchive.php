<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\InventoryArchive
 *
 * @property int $id
 * @property int $order_item_id
 * @property int $inventory_id
 * @property int $quantity_removed
 * @property string|null $reason_removed
 * @property bool $was_adjustment
 * @property int|null $removed_by_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $inventory_is_group
 * @property-read mixed $order_item_quantity
 * @property-read mixed $product_name
 * @property-read mixed $size_name
 * @property-read \App\Models\Inventory $inventory
 * @property-read \App\Models\Order|null $order
 * @property-read \App\Models\OrderItem $orderItem
 * @property-read \App\Models\Product|null $product
 * @property-read \App\Models\User|null $removedBy
 * @property-read \App\Models\Size|null $size
 *
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryArchive newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryArchive newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryArchive query()
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryArchive whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryArchive whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryArchive whereInventoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryArchive whereOrderItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryArchive whereQuantityRemoved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryArchive whereReasonRemoved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryArchive whereRemovedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryArchive whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryArchive whereWasAdjustment($value)
 * @mixin \Eloquent
 */
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

    protected $appends = ['product_name', 'size_name', 'order_item_quantity', 'inventory_is_group'];

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

    public function removedBy()
    {
        return $this->belongsTo(User::class, 'removed_by_id');
    }

    public function getOrderItemQuantityAttribute()
    {
        return $this->orderItem->quantity;
    }

    public function getInventoryIsGroupAttribute()
    {
        return $this->inventory->type == 'group';
    }
}
