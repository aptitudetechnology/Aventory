<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Plant
 *
 * @property int $id
 * @property int $product_id
 * @property string $scientific_name
 * @property string $common_name
 * @property string|null $zone
 * @property int|null $height
 * @property int|null $spread
 * @property string|null $bloom_color
 * @property string|null $fall_color
 * @property string|null $growth_rate
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Feature[] $features
 * @property-read int|null $features_count
 * @property-read \App\Models\Product $product
 * @property-read \App\Models\Team $team
 *
 * @method static \Database\Factories\PlantFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Plant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Plant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Plant query()
 * @method static \Illuminate\Database\Eloquent\Builder|Plant whereBloomColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plant whereCommonName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plant whereFallColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plant whereGrowthRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plant whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plant whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plant whereScientificName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plant whereSpread($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plant whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plant whereZone($value)
 * @mixin \Eloquent
 */
class Plant extends Model
{
    use HasFactory;

    protected $with = ['features'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'team_id',
        'product_id',
        'scientific_name',
        'common_name',
        'zone',
        'height',
        'spread',
        'bloom_color',
        'fall_color',
        'growth_rate',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'team_id' => 'integer',
        'product_id' => 'integer',
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
    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function features()
    {
        return $this->belongsToMany(\App\Models\Feature::class);
    }
}
