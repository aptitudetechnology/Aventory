<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Customer
 *
 * @property int $id
 * @property string $name
 * @property string|null $address
 * @property string|null $city
 * @property string|null $state
 * @property string|null $zip
 * @property bool|null $mailing_same_as_primary
 * @property string|null $mailing_address
 * @property string|null $mailing_city
 * @property string|null $mailing_state
 * @property string|null $mailing_zip
 * @property string|null $notes
 * @property bool|null $is_taxable
 * @property string|null $tax_percentage
 * @property bool $reseller_permit_on_file
 * @property string|null $reseller_permit_expiration
 * @property int $discount_percentage
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $team_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $customer_price_level_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Contact[] $contacts
 * @property-read int|null $contacts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @property-read int|null $orders_count
 * @property-read \App\Models\CustomerPriceLevel|null $priceLevel
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Quote[] $quotes
 * @property-read int|null $quotes_count
 * @property-read \App\Models\Team $team
 *
 * @method static \Database\Factories\CustomerFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newQuery()
 * @method static \Illuminate\Database\Query\Builder|Customer onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCustomerPriceLevelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereDiscountPercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereIsTaxable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereMailingAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereMailingCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereMailingSameAsPrimary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereMailingState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereMailingZip($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereResellerPermitExpiration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereResellerPermitOnFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereTaxPercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereZip($value)
 * @method static \Illuminate\Database\Query\Builder|Customer withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Customer withoutTrashed()
 * @mixin \Eloquent
 */
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
        'reseller_permit_on_file' => 'boolean',
    ];

    protected $with = ['contacts', 'codatRecord'];

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

    public function contacts(): MorphMany
    {
        return $this->morphMany(Contact::class, 'contactable');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function quotes(): HasMany
    {
        return $this->hasMany(Quote::class);
    }

    public function codatPushOp()
    {
        return $this->morphOne(CodatPushOperation::class, 'pushable');
    }

    public function codatRecord()
    {
        return $this->morphOne(CodatRecord::class, 'pushable');
    }
}
