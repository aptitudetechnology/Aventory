<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property int $team_id
 * @property int|null $category_id
 * @property string $name
 * @property string $type
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property bool $is_taxable
 * @property-read \App\Models\Category|null $category
 * @property-read mixed $base_prices
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Inventory[] $inventory
 * @property-read int|null $inventory_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Size[] $inventorySizes
 * @property-read int|null $inventory_sizes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderItem[] $itemsOnHold
 * @property-read int|null $items_on_hold_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderItem[] $itemsSold
 * @property-read int|null $items_sold_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @property-read int|null $orders_count
 * @property-read \App\Models\Plant|null $plant
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Price[] $prices
 * @property-read int|null $prices_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Quote[] $quotes
 * @property-read int|null $quotes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Size[] $sizes
 * @property-read int|null $sizes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Size[] $sizesOnHold
 * @property-read int|null $sizes_on_hold_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Size[] $sizesSold
 * @property-read int|null $sizes_sold_count
 * @property-read \App\Models\Team $team
 *
 * @method static \Database\Factories\ProductFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Query\Builder|Product onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereIsTaxable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Product withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Product withoutTrashed()
 * @mixin \Eloquent
 */
class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $with = ['plant', 'category', 'prices'];

    protected $appends = ['base_prices'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $hidden = [];

    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'team_id' => 'integer',
        'category_id' => 'integer',
        'is_taxable' => 'boolean',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function team()
    {
        return $this->belongsTo(\App\Models\Team::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function plant()
    {
        return $this->hasOne(\App\Models\Plant::class);
    }

    public function prices()
    {
        return $this->hasMany(Price::class);
    }

    public function basePrices()
    {
        if ($this->category) {
            return $this->prices->union($this->category->prices);
        } else {
            return $this->prices;
        }
    }

    public function getBasePricesAttribute()
    {
        return $this->basePrices();
    }

    /**
     * Get price of product for size and customer.
     */
    public function getPrice(Size $size, Customer $customer)
    {
        $price = $this->basePrices()->where('size_id', $size->id)->first();
        if ($price) {
            return $price->getPriceForLevel($customer->price_level);
        } else {
            return 0;
        }
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'prices');
    }

    public function allSizes()
    {
        if ($this->category) {
            return $this->category->sizes()->union($this->sizes);
        } else {
            return $this->sizes();
        }
    }

    public function inventory()
    {
        return $this->hasMany(Inventory::class);
    }

    public function availableInventory()
    {
        return $this->inventory()->where('ready_date', '<=', now());
    }

    public function inventorySizes()
    {
        return $this->belongsToMany(Size::class, 'inventories')->distinct()
            ->withCount([
                'inventories as total_inventory' => function ($query) {
                    $query->where('product_id', $this->id)
                        ->select(DB::raw('sum(quantity)'));
                },

                'inventories as available_count' => function ($query) {
                    $query->where('product_id', $this->id)
                        ->where('ready_date', '<=', now())
                        ->select(DB::raw('sum(quantity)'));
                },
            ])
            ->withCasts([
                'total_inventory' => 'integer',
                'available_count' => 'integer',
            ]);
    }

    public function getAllInventorySizes()
    {
        return $this->inventorySizes->merge($this->sizesOnHold)->merge($this->sizesSold);
    }

    protected function getTotalInventoryForSize(Size $size)
    {
        return $this->inventorySizes()->where('size_id', $size->id)->first()->total_inventory ?? 0;
    }

    protected function getAvailableInventoryForSize(Size $size)
    {
        return $this->inventorySizes()->where('size_id', $size->id)->first()->available_count ?? 0;
    }

    protected function getSoldQuantities(Size $size)
    {
        return $this->itemsSold()->where('size_id', $size->id)->get()->reduce(function ($carry, $item) {
            return $carry + $item->unmatched_quantity;
        }, 0);
    }

    protected function getOnHoldQuantities(Size $size)
    {
        return intval($this->itemsOnHold()
            ->where('size_id', $size->id)
            ->sum('quantity'));
    }

    public function getQuantities(Size $size)
    {
        $size_id = $size->id;
        $product_id = $this->id;
        $total = $this->getTotalInventoryForSize($size);
        $ready = $this->getAvailableInventoryForSize($size);
        $sold = $this->getSoldQuantities($size);
        $on_hold = $this->getOnHoldQuantities($size);
        $available = $ready - $sold - $on_hold;

        return compact('size_id', 'product_id', 'total', 'ready', 'sold', 'on_hold', 'available');
    }

    public function getAllSizeQuantities()
    {
        return $this->inventorySizes
            ->merge($this->sizesSold)
            ->merge($this->sizesOnHold)
            ->map(function ($size) {
                // Get the quantities for this size
                // And add the size name to the array
                return array_merge($this->getQuantities($size), ['size_name' => $size->name]);
            });
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_items', 'product_id', 'order_id');
    }

    public function itemsOnHold()
    {
        return $this->hasMany(OrderItem::class, 'product_id', 'id')
            ->whereRelation('sale', 'is_quote', true)
            ->whereRelation('sale', 'hold_inventory', true);
    }

    public function sizesOnHold()
    {
        return $this->belongsToMany(Size::class, 'order_items')
            ->whereRelation('orders', 'is_quote', true)
            ->whereRelation('orders', 'hold_inventory', true);
    }

    public function itemsSold()
    {
        return $this->hasMany(OrderItem::class, 'product_id', 'id')
            ->whereRelation('order', 'is_quote', false)
            ->whereRelation('order', 'completed', false);
    }

    public function sizesSold()
    {
        return $this->belongsToMany(Size::class, 'order_items')
            ->whereRelation('orders', 'is_quote', false)
            ->whereRelation('orders', 'completed', false);
    }

    public function quotes()
    {
        return $this->belongsToMany(Quote::class, 'order_items', 'product_id', 'order_id');
    }

    public function activeQuotes()
    {
        return $this->quotes()->where('quote_expires', '>=', now());
    }

    public function activeQuotesOnHold()
    {
        return $this->activeQuotes()->where('hold_inventory', true);
    }

    public function pendingOrders()
    {
        return $this->orders()->where('completed', false);
    }
}
