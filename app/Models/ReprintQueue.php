<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ReprintQueue
 *
 * @property int $id
 * @property int $team_id
 * @property int $inventory_id
 * @property int $to_print
 * @property bool $printed
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Inventory $inventory
 * @property-read \App\Models\Team $team
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ReprintQueue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReprintQueue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReprintQueue query()
 * @method static \Illuminate\Database\Eloquent\Builder|ReprintQueue whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReprintQueue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReprintQueue whereInventoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReprintQueue wherePrinted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReprintQueue whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReprintQueue whereToPrint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReprintQueue whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ReprintQueue extends Model
{
    use HasFactory;

    protected $table = 'reprint_queue';

    protected $guarded = [];

    protected $casts = [
        'team_id' => 'integer',
        'inventory_id' => 'integer',
        'to_print' => 'integer',
        'printed' => 'boolean',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }
}
