<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'mailing_same_as_primary' => 'boolean',
        'is_retail' => 'boolean',
        'hide_customer' => 'boolean',
        'no_auto_discount' => 'boolean',
        'reseller_permit_on_file' => 'boolean'
    ];

    protected $guarded = [];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
