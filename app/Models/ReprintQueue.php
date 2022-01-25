<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReprintQueue extends Model
{
    use HasFactory;

    protected $table = "reprint_queue";

    protected $fillable = [
        'inventory_id',
        'to_print',
        'printed',
    ];

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
