<?php

namespace App\Policies;

use App\Entities\User;
use App\Entities\Order;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @param Order $order
     * @return bool
     */
    public function owner(User $user, Order $order)
    {
        return $user->id === $order->user_id;
    }

    /**
     * @param User $user
     * @param int $user_id
     * @return bool
     */
    public function ownerIndex(User $user, int $user_id)
    {
        return $user->id === $user_id;
    }
}
