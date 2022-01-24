<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReprintQueue extends Model
{
    use HasFactory;

    protected $table = "reprint_queue";

    protected $fillable = [
        'purchase_item_id',
        'to_print',
        'printed',
    ];

    protected $casts = [
        'team_id' => 'integer',
        'purchase_item_id' => 'integer',
        'to_print' => 'integer',
        'printed' => 'boolean',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function purchaseItem()
    {
        return $this->belongsTo(PurchaseItem::class);
    }
}
