<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Cache;

class Cart extends Model
{
    /**
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany('App\Product', 'in_carts')
            ->using(InCart::class)
            ->withPivot('stock', 'color_id', 'size_id', 'id', 'product_id');
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
        return $this->belongsTo(User::class);
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
