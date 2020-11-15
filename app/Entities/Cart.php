<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Cache;

class Cart extends Model
{
    protected $guarded = [];

    protected $table = 'carts';

    protected $fillable = [
        'user_id',
        'id'
    ];

    /**
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'in_carts')
            ->using(InCart::class)
            ->withPivot('stock', 'color_id', 'size_id', 'category_id', 'id', 'product_id', 'cart_id');
    }

    /**
     * @return int
     */
    public function productsCount(): int
    {
        return $this->products()->count();
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return string
     */
    public function valorCarrito(): string
    {
        $valor = 0;
        foreach ($this->products as $product) {
            $valor += $product->price * $product->pivot->stock;
        }

        return number_format($valor);
    }

    /**
     * @return float|int
     */
    public function totalCarrito(): int
    {
        $valor = 0;
        foreach ($this->products as $product) {
            $valor += $product->price * $product->pivot->stock;
        }

        return $valor;
    }

    /**
     * @return mixed
     */
    public function getCacheCart()
    {
        return Cache::remember('carts', now()->addDay(), function () {
            return $this->all();
        });
    }
}
