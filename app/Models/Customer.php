<?php

namespace App\Models;

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
        'is_taxable' => 'boolean',
        'no_auto_discount' => 'boolean',
        'reseller_permit_on_file' => 'boolean'
    ];
    protected $with = ['contacts'];

    protected $guarded = [];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function getAddressAttribute()
    {
        return $this->hasMailingAddress() ? $this->mailing_address . ', ' . $this->mailing_city . ', ' . $this->mailing_state . ' ' . $this->mailing_zip : null;
    }

    public function hasMailingAddress(): bool
    {
        return $this->mailing_address !== null && $this->mailing_address !== '';
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
