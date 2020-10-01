<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Cache;

class Size extends Model
{
    protected $guarded = [];

    /**
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany('App\Product')->withTimestamps();
    }

    /**
     * @return mixed
     */
    public function getCacheSizes()
    {
        return Cache::remember('sizes', now()->addDay(), function () {
            return $this->all();
        });
    }
}
