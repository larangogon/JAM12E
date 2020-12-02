<?php

namespace App\Utils;

use Illuminate\Database\Eloquent\Model;

trait CanRate
{
    /**
     * @param null $model
     * @return mixed
     */
    public function ratings($model = null)
    {
        $modelClass = $model ? (new $model)->getMorphClass() : $this->getMorphClass();

        $morphToMany = $this->morphToMany(
            $modelClass,
            'qualifier',
            'ratings',
            'qualifier_id',
            'rateable_id'
        );

        $morphToMany
            ->as('rating')
            ->withTimestamps()
            ->withPivot('rateable_type', 'score')
            ->wherePivot('rateable_type', $modelClass)
            ->wherePivot('qualifier_type', $this->getMorphClass());

        return $morphToMany;
    }

    /**
     * @param Model $model
     * @param float $score
     * @return bool
     */
    public function rate(Model $model, float $score): bool
    {
        if ($this->hasRated($model)) {
            return false;
        }

        $this->ratings($model)->attach($model->getKey(), [
            'score' => $score,
            'rateable_type' => get_class($model)
        ]);

        return true;
    }

    /**
     * @param Model $model
     * @return bool
     */
    public function unrate(Model $model): bool
    {
        if (! $this->hasRated($model)) {
            return false;
        }

        $this->ratings($model->getMorphClass())->detach($model->getKey());

        return true;
    }

    /**
     * @param Model $model
     * @return bool
     */
    public function hasRated(Model $model): bool
    {
        return ! is_null($this->ratings($model->getMorphClass())->find($model->getKey()));
    }
}
