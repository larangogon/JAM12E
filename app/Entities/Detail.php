<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Cache;

class Detail extends Model
{
    protected $guarded = [];

    protected $table = 'details';

    protected $fillable = [
        'total',
        'stock',
        'color_id',
        'category_id',
        'size_id',
        'product_id',
        'order_id'
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
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
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
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * @param $query
     */
    public function scopeColorSales($query)
    {
        $query->with('color')
            ->selectRaw('color_id, SUM(`total`) as total')
            ->groupBy('color_id')
            ->orderByDesc('total')
            ->limit(3);
    }

    /**
     * @param $query
     */
    public function scopeCategorySales($query)
    {
        $query->with('category')
            ->selectRaw('category_id, SUM(`total`) as total')
            ->groupBy('category_id')
            ->orderByDesc('total')
            ->limit(3);
    }

    /**
     * @param $query
     */
    public function scopeSizeSales($query)
    {
        $query->with('size', 'order')
            ->selectRaw('size_id, order_id, SUM(`total`) as total')
            ->groupBy('size_id', 'order_id')
            ->orderByDesc('total')
            ->limit(3);
    }

    /**
     * @param $query
     */
    public function scopeProductSalesTotal($query)
    {
        $query->with('product')
            ->selectRaw('product_id, SUM(`total`) as total')
            ->groupBy('product_id')
            ->orderByDesc('total')
            ->limit(3);
    }

    /**
     * @return BelongsTo
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id');
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
