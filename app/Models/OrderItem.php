<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OrderItem
 *
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property int $size_id
 * @property int $quantity
 * @property int $original_quantity
 * @property float $unit_price
 * @property bool $no_discount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $quantity_fulfilled
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\InventoryArchive[] $archived
 * @property-read int|null $archived_count
 * @property-read mixed $is_fullfilled
 * @property-read mixed $is_matched
 * @property-read mixed $line_discount
 * @property-read mixed $line_total_after_discount
 * @property-read mixed $line_total
 * @property-read mixed $matched_quantity
 * @property-read mixed $product_name
 * @property-read mixed $sale_type
 * @property-read mixed $size_name
 * @property-read mixed $tax_amount
 * @property-read mixed $unmatched_quantity
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Inventory[] $inventory
 * @property-read int|null $inventory_count
 * @property-read \App\Models\Order $order
 * @property-read \App\Models\Product $product
 * @property-read \App\Models\Quote $quote
 * @property-read \App\Models\Sale $sale
 * @property-read \App\Models\Size $size
 *
 * @method static \Database\Factories\OrderItemFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereNoDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereOriginalQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereQuantityFulfilled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereSizeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereUnitPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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

    protected $appends = ['product_name', 'size_name', 'line_total', 'line_discount', 'line_total_after_discount', 'unmatched_quantity', 'sale_type'];

    protected $casts = [
        'product_id' => 'integer',
        'size_id' => 'integer',
        'quantity' => 'integer',
        'unit_price' => 'float',
        'no_discount' => 'boolean',
    ];

    public function getSaleTypeAttribute()
    {
        return $this->sale->type;
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
        return $this->size ? $this->size->name : '';
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
        return $this->archived()->sum('quantity_removed');
    }

    public function getIsFullfilledAttribute()
    {
        return $this->quantity_fulfilled >= $this->quantity;
    }

    public function getLineTotalAttribute()
    {
        return $this->quantity * $this->unit_price;
    }

    public function getLineDiscountAttribute()
    {
        return $this->no_discount ? 0 : $this->line_total * ($this->sale->discount_percentage / 100);
    }

    public function getLineTotalAfterDiscountAttribute()
    {
        return $this->line_total - $this->line_discount;
    }

    public function getTaxAmountAttribute()
    {
        if ($this->product->is_taxable && $this->sale->is_taxable) {
            return $this->line_total_after_discount * $this->sale->tax_percentage / 100;
        } else {
            return 0;
        }
    }
}
