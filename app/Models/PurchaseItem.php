<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\PurchaseItem
 *
 * @property int $id
 * @property int $purchase_id
 * @property int $product_id
 * @property int|null $size_id
 * @property float $unit_price
 * @property int $quantity_ordered
 * @property int $quantity_confirmed
 * @property bool $received
 * @property bool $printed
 * @property bool $in_inventory
 * @property \Illuminate\Support\Carbon|null $ready_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $original_size_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Inventory[] $inventory
 * @property-read int|null $inventory_count
 * @property-read \App\Models\Product $product
 * @property-read \App\Models\Purchase $purchase
 * @property-read \App\Models\Size|null $size
 * @method static \Database\Factories\PurchaseItemFactory factory(...$parameters)
 * @method static Builder|PurchaseItem newModelQuery()
 * @method static Builder|PurchaseItem newQuery()
 * @method static Builder|PurchaseItem query()
 * @method static Builder|PurchaseItem whereCreatedAt($value)
 * @method static Builder|PurchaseItem whereId($value)
 * @method static Builder|PurchaseItem whereInInventory($value)
 * @method static Builder|PurchaseItem whereOriginalSizeId($value)
 * @method static Builder|PurchaseItem wherePrinted($value)
 * @method static Builder|PurchaseItem whereProductId($value)
 * @method static Builder|PurchaseItem wherePurchaseId($value)
 * @method static Builder|PurchaseItem whereQuantityConfirmed($value)
 * @method static Builder|PurchaseItem whereQuantityOrdered($value)
 * @method static Builder|PurchaseItem whereReadyDate($value)
 * @method static Builder|PurchaseItem whereReceived($value)
 * @method static Builder|PurchaseItem whereSizeId($value)
 * @method static Builder|PurchaseItem whereUnitPrice($value)
 * @method static Builder|PurchaseItem whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PurchaseItem extends Model
{
    use HasFactory;
    protected static function boot()
    {
        parent::boot();

        // Order by sort_num by default
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy(Product::select('name')->whereColumn('products.id', 'purchase_items.product_id'));
        });
    }

    protected $with = ['product:id,name', 'size:id,name'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'purchase_id',
        'product_id',
        'original_size_id',
        'size_id',
        'unit_price',
        'quantity_ordered',
        'quantity_confirmed',
        'received',
        'printed',
        'in_inventory',
        'ready_date'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'purchase_id' => 'integer',
        'product_id' => 'integer',
        'original_size_id' => 'integer',
        'size_id' => 'integer',
        'unit_price' => 'double',
        'received' => 'boolean',
        'printed' => 'boolean',
        'in_inventory' => 'boolean',
        'ready_date' => 'date:Y-m-d'
    ];

    protected function addedToInventory()
    {
        $this->update([
            'in_inventory' => true,
            'received' => true
        ]);
    }

    public function removeFromInventory()
    {
        DB::table('inventories')->where('purchase_item_id', $this->id)->delete();

        $this->update([
            'in_inventory' => false,
            'printed' => false
        ]);
    }

    public function addToGroupInventory($blockId, $nuseryLocationId)
    {
        if ($this->in_inventory) {
            return;
        } else {
            auth()->user()->currentTeam->inventories()->create([
                'purchase_item_id' => $this->id,
                'product_id' => $this->product_id,
                'original_size_id' => $this->original_size_id,
                'size_id' => $this->size_id,
                'nursery_location_id' => $nuseryLocationId,
                'block_id' => $blockId,
                'quantity' => $this->quantity_confirmed,
                'type' => 'group',
                'ready_date' => $this->ready_date
            ]);

            $this->addedToInventory();
        }
    }

    public function addToIndividualInventory($blockId, $nuseryLocationId)
    {
        if ($this->in_inventory) {
            return;
        } else {
            $currentTeam = auth()->user()->currentTeam;
            $item = 1;
            while ($item++ <= $this->quantity_confirmed) {
                $currentTeam->inventories()->create([
                    'purchase_item_id' => $this->id,
                    'product_id' => $this->product_id,
                    'original_size_id' => $this->original_size_id,
                    'size_id' => $this->size_id,
                    'nursery_location_id' => $nuseryLocationId,
                    'block_id' => $blockId,
                    'quantity' => 1,
                    'type' => 'individual',
                    'ready_date' => $this->ready_date
                ]);
            }

            $this->addedToInventory();
        }
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function size()
    {
        return $this->belongsTo(\App\Models\Size::class);
    }

    public function inventory()
    {
        return $this->hasMany(Inventory::class);
    }
}
