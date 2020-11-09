<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Rating extends Pivot
{
    public $incrementing = true;

    protected $table = 'ratings';

    public function rateable()
    {
        return $this->morphTo();
    }

    public function qualifier()
    {
        return $this->morphTo();
    }

    /**
     * @param Builder $query
     */
    public function scopeTopRating($query)
    {
        $query->with('rateable')
            ->selectRaw('rateable_id, rateable_type, SUM(`score`) as score')
            ->groupBy('rateable_id', 'rateable_type')
            ->orderByDesc('score')
            ->limit(4);
    }
}
