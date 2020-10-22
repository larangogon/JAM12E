<?php

namespace App\Policies;

use App\Entities\User;
use App\Entities\Order;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    public function owner(User $user, Order $order)
    {
        return $user->id === $order->user_id;
    }

    public function ownerIndex(User $user, int $user_id)
    {
        return $user->id === $user_id;
    }
}
