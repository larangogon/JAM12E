<?php

namespace App\Observers;

class UserObserver
{
    /**
     * @param $user
     */
    public function created($user)
    {
        logger()->channel('stack')->info('se ha creado un usuario', [
            'id'   => $user->id,
            'name' => $user->name,
        ]);
    }

    /**
     * @param $user
     */
    public function updated($user)
    {
        logger()->channel('stack')->info('se ha editado un usuario', [
            'id'   => $user->id,
            'name' => $user->name,
        ]);
    }
}
