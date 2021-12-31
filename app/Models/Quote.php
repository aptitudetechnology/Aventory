<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class Quote extends Order
{
    protected $attributes = [
        'is_quote' => true,
    ];

    protected $casts = [
        'is_quote' => 'boolean',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'quote_expires',
        'date',
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
