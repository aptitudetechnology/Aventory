<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DeliveryStatus
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryStatus whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryStatus whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DeliveryStatus extends Model
{
    use HasFactory;
}
