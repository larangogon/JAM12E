<?php

namespace App\Observers;


class RatingObserver
{
    /**
     * @param $rating
     */
    public function created($rating)
    {
        $rating->votos += 1;

        $rating->save();
    }
}
