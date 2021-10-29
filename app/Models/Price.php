<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
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
}
