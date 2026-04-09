<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        'total',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function details(): HasMany
    {
        return $this->hasMany(Detail::class);
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }

    public function getCacheOrder()
    {
        return Cache::remember('orders', now()->addDay(), function () {
            return $this->all();
        });
    }

    public function shipping(): HasOne
    {
        return $this->hasOne(Shipping::class);
    }

    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query
                ->where('status', 'LIKE', "%$search%");
        }
    }

    public function scopeStatus($query, $status)
    {
        if ($status) {
            return $query
                ->where('status', 'LIKE', "%$status%");
        }
    }

    public function scopeStartDate($query, $startDate)
    {
        if ($startDate) {
            return $query->where('created_at', 'LIKE', "%$startDate%");
        }
    }

    public function scopeEndDate($query, $endDate)
    {
        if ($endDate) {
            return $query
                ->where('created_at', 'LIKE', "%$endDate%");
        }
    }

    public function scopeUserSales($query)
    {
        $query->with('user')
            ->selectRaw('user_id, SUM(`total`) as total')
            ->groupBy('user_id')
            ->orderByDesc('total')
            ->limit(3);
    }
}
