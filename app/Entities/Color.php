<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Cache;

class Color extends Model
{
    protected $guarded = [];

    /**
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany('App\Entities\Product')
            ->withTimestamps();
    }

    /**
     * @return mixed
     */
    public function getCacheColor()
    {
        return Cache::remember('colors', now()->addDay(), function () {
            return $this->all();
        });
    }
}
