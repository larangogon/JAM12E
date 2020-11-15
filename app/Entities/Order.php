<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Traits\HasRoles;

class Order extends Model
{
    use HasRoles;

    protected $guarded = [];

    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'id',
        'status',
        'total'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
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
        return Cache::remember('orders', now()->addDay(), function () {
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
            return $query
                ->where('status', 'LIKE', "%$search%");
        }
    }

    /**
     * @param $query
     * @param $status
     * @return mixed
     */
    public function scopeStatus($query, $status)
    {
        if ($status) {
            return $query
                ->where('status', 'LIKE', "%$status%");
        }
    }

    /**
     * @param $query
     * @param $fechaInicio
     * @return mixed
     */
    public function scopeFechaInicio($query, $fechaInicio)
    {
        if ($fechaInicio) {
            return $query
                ->where('created_at', 'LIKE', "%$fechaInicio%");
        }
    }

    /**
     * @param $query
     * @param $fechaFinal
     * @return mixed
     */
    public function scopeFechaFinal($query, $fechaFinal)
    {
        if ($fechaFinal) {
            return $query
                ->where('created_at', 'LIKE', "%$fechaFinal%");
        }
    }
}
