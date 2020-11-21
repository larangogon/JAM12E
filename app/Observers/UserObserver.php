<?php

namespace App\Observers;

use App\Entities\Cart;

class UserObserver
{
    /**
     * @param $user
     */
    public function created($user)
    {
        $this->cart = new Cart();

        $this->cart->user_id = $user->id;
        $this->cart->save();

        logger()->channel('stack')->info('se ha creado un usuario', [
            'id'   => $user->id,
            'name' => $user->name,
        ]);
    }
}
