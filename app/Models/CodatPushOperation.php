<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class CodatPushOperation extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function pushable(): MorphTo
    {
        return $this->morphTo();
    }
}
