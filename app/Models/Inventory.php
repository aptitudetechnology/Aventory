<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Inventory
 *
 * @property int $id
 * @property int $team_id
 * @property int $purchase_item_id
 * @property int $product_id
 * @property int|null $original_size_id
 * @property int|null $size_id
 * @property int $quantity
 * @property string $type
 * @property int|null $block_id
 * @property int|null $place_id
 * @property Carbon $ready_date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $nursery_location_id
 * @property-read \App\Models\Block|null $block
 * @property-read mixed $block_name
 * @property-read mixed $last_inventory_date
 * @property-read mixed $place_name
 * @property-read mixed $quantity_to_print
 * @property-read \App\Models\NurseryLocation $nurseryLocation
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderItem[] $orderItems
 * @property-read int|null $order_items_count
 * @property-read \App\Models\Size|null $originalSize
 * @property-read \App\Models\Place|null $place
 * @property-read \App\Models\Product $product
 * @property-read \App\Models\PurchaseItem $purchaseItem
 * @property-read \App\Models\ReprintQueue|null $reprintQueue
 * @property-read \App\Models\Size|null $size
 * @property-read \App\Models\Team $team
 *
 * @method static \Database\Factories\InventoryFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory query()
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereBlockId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereNurseryLocationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereOriginalSizeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory wherePlaceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory wherePurchaseItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereReadyDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereSizeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Inventory extends Model
{
    use HasFactory;

    protected $with = ['product', 'size', 'block', 'place', 'nurseryLocation'];

    protected $appends = ['last_inventory_date', 'block_name', 'place_name'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'purchase_item_id',
        'product_id',
        'original_size_id',
        'size_id',
        'quantity',
        'type',
        'nursery_location_id',
        'block_id',
        'place_id',
        'ready_date',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'purchase_item_id' => 'integer',
        'product_id' => 'integer',
        'original_size_id' => 'integer',
        'size_id' => 'integer',
        'nursery_location_id' => 'integer',
        'block_id' => 'integer',
        'place_id' => 'integer',
        'ready_date' => 'datetime',
    ];

    public function getLastInventoryDateAttribute()
    {
        if ($this->updated_at == $this->created_at) {
            return 'Never Inventoried';
        } else {
            return $this->updated_at?->diffForHumans() ?? 'Never Inventoried';
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function purchaseItem()
    {
        return $this->belongsTo(\App\Models\PurchaseItem::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function orderItems()
    {
        return $this->belongsToMany(\App\Models\OrderItem::class, 'inventory_archive', 'inventory_id', 'order_item_id');
    }

    public function nurseryLocation()
    {
        return $this->belongsTo(\App\Models\NurseryLocation::class, 'nursery_location_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function block()
    {
        return $this->belongsTo(\App\Models\Block::class);
    }

    public function getBlockNameAttribute()
    {
        return $this->block ? $this->block->name : 'Unassigned';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function place()
    {
        return $this->belongsTo(\App\Models\Place::class);
    }

    public function getPlaceNameAttribute()
    {
        if ($this->place) {
            return 'Row: ' . $this->place->row_number . '- #' . $this->place->plant_number;
        }
        if ($this->type == 'group') {
            return 'Located in Group';
        }

        return 'Unassigned';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function originalSize()
    {
        return $this->belongsTo(\App\Models\Size::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function size()
    {
        return $this->belongsTo(\App\Models\Size::class);
    }

    public function team()
    {
        return $this->belongsTo(\App\Models\Team::class);
    }

    public function reprintQueue()
    {
        return $this->hasOne(ReprintQueue::class);
    }

    public function getQuantityToPrintAttribute()
    {
        return $this->reprintQueue ? $this->reprintQueue->to_print : $this->quantity;
    }
}
