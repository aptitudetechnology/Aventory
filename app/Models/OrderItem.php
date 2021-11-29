<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $table = 'order_items';
    protected $guarded = [];
    protected $appends = ['product_name', 'size_name'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getProductNameAttribute()
    {
        return $this->product->name;
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }
    public function getSizeNameAttribute()
    {
        return $this->size->name;
    }
}
