<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Jetstream\Events\TeamCreated;
use Laravel\Jetstream\Events\TeamDeleted;
use Laravel\Jetstream\Events\TeamUpdated;
use Laravel\Jetstream\Team as JetstreamTeam;

class Team extends JetstreamTeam
{
    use HasFactory;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'personal_team' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'personal_team',
    ];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => TeamCreated::class,
        'updated' => TeamUpdated::class,
        'deleted' => TeamDeleted::class,
    ];

    public function customers(): HasMany
    {
        return $this->hasMany(Customer::class)->orderBy('name');
    }

    public function vendors(): HasMany
    {
        return $this->hasMany(Vendor::class)->orderBy('name');
    }

    public function priceLevels(): HasMany
    {
        return $this->hasMany(customerPriceLevel::class);
    }

    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class)->orderBy('type')->orderBy('name');
    }

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class)->orderBy('name');
    }

    public function plants(): HasMany
    {
        return $this->hasManyThrough(Plant::class, 'products')->orderBy('scientific_name');
    }

    public function features(): HasMany
    {
        return $this->hasMany(Feature::class)->orderBy('name');
    }
}
