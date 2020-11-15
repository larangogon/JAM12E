<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Cache;

class InCart extends Pivot
{
    protected $table = 'in_carts';

    protected $guarded = [];

    protected $fillable = [
        'stock',
        'color_id',
        'size_id',
        'category_id',
        'id',
        'product_id',
        'cart_id'
    ];

    /**
     * @return BelongsTo
     */
    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class, 'color_id');
    }

    /**
     * @return BelongsTo
     */
    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }

    /**
     * @return BelongsTo
     */
    public function size(): BelongsTo
    {
        return $this->belongsTo(Size::class, 'size_id');
    }

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Size::class, 'category_id');
    }

    /**
     * @return BelongsTo
     */
    public function products(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * @return mixed
     */
    public function getCacheInCarts()
    {
        return Cache::remember('in_carts', now()->addDay(), function () {
            return $this->all();
        });
    }
}
