<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Size
 *
 * @property int $id
 * @property string $name
 * @property int $team_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $next_size_id
 * @property int $sort_num
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Inventory[] $inventories
 * @property-read int|null $inventories_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderItem[] $orderItems
 * @property-read int|null $order_items_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @property-read int|null $orders_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @property-read \App\Models\Team $team
 *
 * @method static \Database\Factories\SizeFactory factory(...$parameters)
 * @method static Builder|Size newModelQuery()
 * @method static Builder|Size newQuery()
 * @method static \Illuminate\Database\Query\Builder|Size onlyTrashed()
 * @method static Builder|Size query()
 * @method static Builder|Size whereCreatedAt($value)
 * @method static Builder|Size whereDeletedAt($value)
 * @method static Builder|Size whereId($value)
 * @method static Builder|Size whereName($value)
 * @method static Builder|Size whereNextSizeId($value)
 * @method static Builder|Size whereSortNum($value)
 * @method static Builder|Size whereTeamId($value)
 * @method static Builder|Size whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Size withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Size withoutTrashed()
 * @mixin \Eloquent
 */
class Size extends Model
{
    use HasFactory, SoftDeletes;

    protected static function boot()
    {
        parent::boot();

        // Order by sort_num by default
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('sort_num', 'asc');
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'next_size_id',
        'sort_num',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'next_size_id' => 'integer',
        'sort_num' => 'integer',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'inventories');
    }

    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_items');
    }
}
