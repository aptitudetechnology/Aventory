<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class Quote extends Sale
{
    protected $attributes = [
        'is_quote' => true,
    ];

    protected $appends = ['total_of_items_with_discount', 'type', 'name', 'full_name', 'route', 'status'];

    protected static function booted()
    {
        static::addGlobalScope('quote', function (Builder $builder) {
            $builder->where('is_quote', true);
        });
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'from_quote_id');
    }

    public function getStatusAttribute()
    {
        if ($this->isFullfilled()) {
            return 'Fulfilled';
        } else if ($this->isPartiallyFullfilled()) {
            return 'Partially Fulfilled';
        } else if ($this->isExpired()) {
            return 'Expired';
        } else {
            return 'Pending';
        }
    }

    public function isFullfilled()
    {
        return $this->items->every(function ($item) {
            return $item->quantity_fulfilled >= $item->quantity;
        });
    }

    public function isPartiallyFullfilled()
    {
        return $this->orders->count() > 0;
    }

    public function isExpired()
    {
        return $this->quote_expires < now();
    }
}
