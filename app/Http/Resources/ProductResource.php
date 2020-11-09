<?php

namespace App\Http\Resources;

use App\Entities\User;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'user_rating' => $this->averageRating(User::class),
        ];
    }
}
