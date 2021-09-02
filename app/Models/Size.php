<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Size extends Model
{
    use HasFactory, SoftDeletes;

    protected static function boot()
    {
        parent::boot();

        // Order by sort_num by default
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('sort_num', 'asc');
        });
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'next_size_id',
        'sort_num'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'next_size_id' => 'integer',
        'sort_num' => 'integer'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function next_size()
    {
        return $this->belongsTo(\App\Models\Size::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
