<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\Price
 *
 * @property int $id
 * @property int|null $product_id
 * @property int|null $category_id
 * @property int $size_id
 * @property float $unit_price
 * @property bool $show_on_availability
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category|null $category
 * @property-read \App\Models\Product|null $product
 * @property-read \App\Models\Size $size
 * @method static Builder|Price newModelQuery()
 * @method static Builder|Price newQuery()
 * @method static Builder|Price query()
 * @method static Builder|Price whereCategoryId($value)
 * @method static Builder|Price whereCreatedAt($value)
 * @method static Builder|Price whereId($value)
 * @method static Builder|Price whereProductId($value)
 * @method static Builder|Price whereShowOnAvailability($value)
 * @method static Builder|Price whereSizeId($value)
 * @method static Builder|Price whereUnitPrice($value)
 * @method static Builder|Price whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Price extends Model
{
    use HasFactory;
    protected $table = 'prices';
    protected $with = ['size'];
    protected static function boot()
    {
        parent::boot();

        // Order by sort_num by default
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy(Size::select('sort_num')->whereColumn('sizes.id', 'prices.size_id'));
        });
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'category_id',
        'size_id',
        'unit_price',
        'show_on_availability'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'product_id' => 'integer',
        'category_id' => 'integer',
        'size_id' => 'integer',
        'show_on_availability' => 'boolean'
    ];

    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getPriceForLevel(CustomerPriceLevel $level = null)
    {
        if ($level) {
            return $this->unit_price * ($level->percentage_more / 100) + $this->unit_price;
        } else {
            return $this->unit_price;
        }
    }
}
