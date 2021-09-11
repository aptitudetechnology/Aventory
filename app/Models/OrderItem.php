<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class OrderItem extends Model
{
    use HasFactory;
    protected static function boot()
    {
        parent::boot();

        // Order by sort_num by default
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy(Product::select('name')->whereColumn('products.id', 'order_items.product_id'));
        });
    }

    protected $with = ['product:id,name', 'size:id,name'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'product_id',
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
        'order_id' => 'integer',
        'product_id' => 'integer',
        'size_id' => 'integer',
        'unit_price' => 'double',
        'received' => 'boolean',
        'printed' => 'boolean',
        'in_inventory' => 'boolean',
        'ready_date' => 'date'
    ];

    protected function addedToInventory()
    {
        $this->update([
            'in_inventory' => true,
            'received' => true
        ]);
    }

    public function addToGroupInventory()
    {
        if ($this->in_inventory) {
            return;
        } else {
            auth()->user()->currentTeam->inventories()->create([
                'order_item_id' => $this->id,
                'product_id' => $this->product_id,
                'original_size_id' => $this->size_id,
                'size_id' => $this->size_id,
                'quantity' => $this->quantity_confirmed,
                'type' => 'group',
                'ready_date' => $this->ready_date
            ]);

            $this->addedToInventory();
        }
    }

    public function addToIndividualInventory()
    {
        if ($this->in_inventory) {
            return;
        } else {
            $currentTeam = auth()->user()->currentTeam;
            $item = 1;
            while ($item++ <= $this->quantity_confirmed) {
                $currentTeam->inventories()->create([
                    'order_item_id' => $this->id,
                    'product_id' => $this->product_id,
                    'original_size_id' => $this->size_id,
                    'size_id' => $this->size_id,
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
    public function order()
    {
        return $this->belongsTo(\App\Models\Order::class);
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
}
