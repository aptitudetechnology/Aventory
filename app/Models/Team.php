<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Jetstream\Events\TeamCreated;
use Laravel\Jetstream\Events\TeamDeleted;
use Laravel\Jetstream\Events\TeamUpdated;
use Laravel\Jetstream\Team as JetstreamTeam;

/**
 * App\Models\Team
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property bool $personal_team
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Quote[] $activeQuotes
 * @property-read int|null $active_quotes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Block[] $blocks
 * @property-read int|null $blocks_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Category[] $categories
 * @property-read int|null $categories_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Contact[] $contacts
 * @property-read int|null $contacts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Customer[] $customers
 * @property-read int|null $customers_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Feature[] $features
 * @property-read int|null $features_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Inventory[] $inventories
 * @property-read int|null $inventories_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Inventory[] $inventoryToReprint
 * @property-read int|null $inventory_to_reprint_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\NurseryLocation[] $nurseryLocations
 * @property-read int|null $nursery_locations_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @property-read int|null $orders_count
 * @property-read \App\Models\User $owner
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CustomerPriceLevel[] $priceLevels
 * @property-read int|null $price_levels_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Purchase[] $purchases
 * @property-read int|null $purchases_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Quote[] $quotes
 * @property-read int|null $quotes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ReprintQueue[] $reprintQueue
 * @property-read int|null $reprint_queue_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Size[] $sizes
 * @property-read int|null $sizes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TeamInvitation[] $teamInvitations
 * @property-read int|null $team_invitations_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Vendor[] $vendors
 * @property-read int|null $vendors_count
 * @method static \Database\Factories\TeamFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Team newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Team newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Team query()
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team wherePersonalTeam($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereUserId($value)
 * @mixin \Eloquent
 */
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
        return $this->hasMany(CustomerPriceLevel::class)->orderBy('name');
    }

    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class)->orderBy('name');
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

    public function sizes(): HasMany
    {
        return $this->hasMany(Size::class);
    }

    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class);
    }

    public function inventories(): HasMany
    {
        return $this->hasMany(Inventory::class);
    }

    public function nurseryLocations(): HasMany
    {
        return $this->hasMany(NurseryLocation::class);
    }

    public function blocks(): HasMany
    {
        return $this->hasMany(Block::class)->orderBy('name');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function quotes(): HasMany
    {
        return $this->hasMany(Quote::class);
    }

    public function activeQuotes(): HasMany
    {
        return $this->quotes()->where('quote_expires', '>=', now());
    }

    public function reprintQueue(): HasMany
    {
        return $this->hasMany(ReprintQueue::class);
    }

    public function inventoryToReprint()
    {
        return $this->belongsToMany(Inventory::class, 'reprint_queue')
            ->withPivot('printed', 'created_at', 'to_print')
            ->with('product', 'size', 'block');
    }
}
