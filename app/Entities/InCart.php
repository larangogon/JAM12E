<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

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
        'cart_id',
    ];

    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class, 'color_id');
    }

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }

    public function size(): BelongsTo
    {
        return $this->belongsTo(Size::class, 'size_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Size::class, 'category_id');
    }

    public function products(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
