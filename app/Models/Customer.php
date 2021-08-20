<?php

namespace App\Models;

use App\Policies\CustomerPolicy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'mailing_same_as_primary' => 'boolean',
        'is_retail' => 'boolean',
        'no_auto_discount' => 'boolean',
        'reseller_permit_on_file' => 'boolean'
    ];
    protected $with = ['contacts'];

    protected $guarded = [];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function priceLevel(): BelongsTo
    {
        return $this->belongsTo(CustomerPriceLevel::class, 'customer_price_level_id');
    }

    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class);
    }
}
