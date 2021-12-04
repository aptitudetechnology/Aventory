<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $with = ['plant', 'category', 'prices',];
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

    public function getBasePricesAttribute()
    {
        if ($this->category) {
            return $this->prices->union($this->category->prices);
        } else {
            return $this->prices;
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
                }
            ]);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_items', 'product_id', 'order_id');
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
