<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Block
 *
 * @property int $id
 * @property int $team_id
 * @property string $name
 * @property int|null $nursery_location_id
 * @property bool $has_places
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $block_display_name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Inventory[] $inventories
 * @property-read int|null $inventories_count
 * @property-read \App\Models\NurseryLocation|null $nurseryLocation
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Place[] $places
 * @property-read int|null $places_count
 * @property-read \App\Models\Team $team
 *
 * @method static \Database\Factories\BlockFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Block newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Block newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Block query()
 * @method static \Illuminate\Database\Eloquent\Builder|Block whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Block whereHasPlaces($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Block whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Block whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Block whereNurseryLocationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Block whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Block whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Block extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'nursery_location_id',
        'has_places',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nursery_location_id' => 'integer',
        'has_places' => 'boolean',
    ];

    protected $appends = ['BlockDisplayName'];

    public function getBlockDisplayNameAttribute()
    {
        return 'Block : '.$this->name;
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function nurseryLocation()
    {
        return $this->belongsTo(\App\Models\NurseryLocation::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function places()
    {
        return $this->hasMany(\App\Models\Place::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inventories()
    {
        return $this->hasMany(\App\Models\Inventory::class);
    }
}
