<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Permission\Traits\HasRoles;

class Order extends Model
{
    use HasRoles;

    protected $fillable = ['user_id', 'id', 'status', 'total'];

    protected $table = 'orders';

    protected $guarded = [];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany
     */
    public function details(): HasMany
    {
        return $this->hasMany(Detail::class);
    }

    /**
     * @return HasOne
     */
    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }

    /**
     * @return mixed
     */
    public function getCacheOrder()
    {
        return Cache::remember('Orders', now()->addDay(), function () {
            return $this->all();
        });
    }

    /**
     * @return HasOne
     */
    public function shipping(): HasOne
    {
        return $this->hasOne(Shipping::class);
    }

    /**
     * @param $query
     * @param $search
     * @return mixed
     */
    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where('status', 'LIKE', "%$search%");
        }
    }
}
