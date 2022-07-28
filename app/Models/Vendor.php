<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Vendor
 *
 * @property int $id
 * @property int $team_id
 * @property string $name
 * @property string|null $vendor_code
 * @property string|null $address
 * @property string|null $city
 * @property string|null $state
 * @property string|null $zip
 * @property bool $mailing_same_as_primary
 * @property string|null $mailing_address
 * @property string|null $mailing_city
 * @property string|null $mailing_state
 * @property string|null $mailing_zip
 * @property string|null $notes
 * @property bool $use_for_block_transfers
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Contact[] $contacts
 * @property-read int|null $contacts_count
 * @property-read \App\Models\Team $team
 *
 * @method static \Database\Factories\VendorFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor newQuery()
 * @method static \Illuminate\Database\Query\Builder|Vendor onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor query()
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereMailingAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereMailingCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereMailingSameAsPrimary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereMailingState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereMailingZip($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereUseForBlockTransfers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereVendorCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereZip($value)
 * @method static \Illuminate\Database\Query\Builder|Vendor withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Vendor withoutTrashed()
 * @mixin \Eloquent
 */
class Vendor extends Model
{
    use HasFactory, SoftDeletes;

    protected $with = ['contacts'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'team_id',
        'name',
        'vendor_code',
        'address',
        'city',
        'state',
        'zip',
        'mailing_same_as_primary',
        'mailing_address',
        'mailing_city',
        'mailing_state',
        'mailing_zip',
        'notes',
        'use_for_block_transfers',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'team_id' => 'integer',
        'mailing_same_as_primary' => 'boolean',
        'use_for_block_transfers' => 'boolean',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contacts(): MorphMany
    {
        return $this->morphMany(Contact::class, 'contactable');
    }
}
