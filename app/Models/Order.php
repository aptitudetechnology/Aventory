<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $with = ['customer', 'teamMember'];

    protected $guarded = [];


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
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function teamMember()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
