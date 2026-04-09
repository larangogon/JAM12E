<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Cart extends Model
{
    protected $guarded = [];

    protected $table = 'carts';

    protected $fillable = [
        'user_id',
        'id',
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'in_carts')
            ->using(InCart::class)
            ->withPivot('stock', 'color_id', 'size_id', 'category_id', 'id', 'product_id', 'cart_id');
    }

    public function productsCount(): int
    {
        return $this->products()->count();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function valueCart(): int
    {
        $valor = 0;

        foreach ($this->products as $product) {
            $valor += $product->price * $product->pivot->stock;
        }

        return $valor;
    }
}
