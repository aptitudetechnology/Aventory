<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    protected $with = ['product', 'size', 'block', 'place'];
    protected $appends = ['last_inventory_date'];
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
        'ready_date'
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
        'ready_date' => 'datetime'
    ];

    public function getLastInventoryDateAttribute()
    {
        if ($this->updated_at == $this->created_at) {
            return "Never Inventoried";
        } else {
            return $this->updated_at->diffForHumans();
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


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function block()
    {
        return $this->belongsTo(\App\Models\Block::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function place()
    {
        return $this->belongsTo(\App\Models\Place::class);
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
