<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Order extends Model
{
    use HasFactory;
    protected $with = ['customer', 'teamMember', 'deliveryStatus', 'paymentStatus'];
    protected $table = 'orders';
    protected $guarded = [];

    protected $attributes = [
        'is_quote' => false,
    ];

    protected static function booted()
    {
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->where('is_quote', false);
        });
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'date' => 'date:Y-m-d',
        'quote_expires' => 'date:Y-m-d',
        'customer_id' => 'integer',
        'team_member_id' => 'integer',
        'team_id' => 'integer',
        'delivery_status_id' => 'integer',
        'payment_status_id' => 'integer',
        'quote_id' => 'integer',
        'is_taxable' => 'boolean',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function teamMember()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
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
