<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Color extends Model
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
    public function getCacheColor()
    {
        return Cache::remember('colors', now()->addDay(), function () {
            return $this->all();
        });
    }
}
