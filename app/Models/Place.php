<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Place
 *
 * @property int $id
 * @property int $block_id
 * @property int $row_number
 * @property int $plant_number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Block $block
 * @property-read \App\Models\Inventory|null $inventory
 * @method static \Database\Factories\PlaceFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Place newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Place newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Place query()
 * @method static \Illuminate\Database\Eloquent\Builder|Place whereBlockId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Place whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Place whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Place wherePlantNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Place whereRowNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Place whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Place extends Model
{
    use HasFactory;

    /** 
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'block_id',
        'row_number',
        'plant_number',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'block_id' => 'integer',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function block()
    {
        return $this->belongsTo(\App\Models\Block::class);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function inventory()
    {
        return $this->hasOne(\App\Models\Inventory::class);
    }
}
