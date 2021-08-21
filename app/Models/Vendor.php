<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
}
