<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\NurseryLocation
 *
 * @property int $id
 * @property int $team_id
 * @property string $name
 * @property string|null $location_code
 * @property string|null $address
 * @property string|null $city
 * @property string|null $state
 * @property string|null $zip
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Block[] $blocks
 * @property-read int|null $blocks_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Inventory[] $inventory
 * @property-read int|null $inventory_count
 * @property-read \App\Models\Team $team
 *
 * @method static \Database\Factories\NurseryLocationFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|NurseryLocation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NurseryLocation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NurseryLocation query()
 * @method static \Illuminate\Database\Eloquent\Builder|NurseryLocation whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NurseryLocation whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NurseryLocation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NurseryLocation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NurseryLocation whereLocationCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NurseryLocation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NurseryLocation whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NurseryLocation whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NurseryLocation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NurseryLocation whereZip($value)
 * @mixin \Eloquent
 */
class NurseryLocation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'location_code',
        'address',
        'city',
        'state',
        'zip',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    public function inventory()
    {
        return $this->hasMany(Inventory::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function blocks()
    {
        return $this->hasMany(\App\Models\Block::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function team()
    {
        return $this->belongsTo(\App\Models\Team::class);
    }
}
