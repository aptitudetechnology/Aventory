<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;


class Order extends Sale
{
    use HasFactory;
    protected $with = ['customer', 'teamMember', 'deliveryStatus', 'paymentStatus'];

    protected $attributes = [
        'is_quote' => false,
    ];


    protected static function booted()
    {
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->where('is_quote', false);
        });
    }

    public function paymentStatus()
    {
        return $this->belongsTo(PaymentStatus::class);
    }

    public function deliveryStatus()
    {
        return $this->belongsTo(DeliveryStatus::class);
    }

    public function quote()
    {
        return $this->belongsTo(Quote::class, 'from_quote_id');
    }
}
