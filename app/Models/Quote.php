<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class Quote extends Sale
{
    protected $attributes = [
        'is_quote' => true,
    ];

    protected static function booted()
    {
        static::addGlobalScope('quote', function (Builder $builder) {
            $builder->where('is_quote', true);
        });
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
