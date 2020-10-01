<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Cache;

class Imagen extends Model
{
    protected $guarded = [];

    protected $table = 'imagenes';

    /**
     *
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * @return mixed
     */
    public function getCacheImagenes()
    {
        return Cache::remember('imagenes', now()->addDay(), function () {
            return $this->all();
        });
    }
}
