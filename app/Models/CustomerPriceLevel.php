<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\CustomerPriceLevel
 *
 * @property int $id
 * @property int $team_id
 * @property string $name
 * @property string|null $description
 * @property int $percentage_more
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Customer[] $customers
 * @property-read int|null $customers_count
 * @property-read \App\Models\Team $team
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerPriceLevel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerPriceLevel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerPriceLevel query()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerPriceLevel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerPriceLevel whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerPriceLevel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerPriceLevel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerPriceLevel wherePercentageMore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerPriceLevel whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerPriceLevel whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CustomerPriceLevel extends Model
{
    use HasFactory;
    protected $guarded = [];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'team_id',
        'name',
        'description',
        'percentage_more',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'percentage_more' => 'integer',
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function customers(): HasMany
    {
        return $this->hasMany(Customer::class);
    }
}
