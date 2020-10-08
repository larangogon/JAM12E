<?php

namespace App\Observers;

class UserObserver
{
    public function created($user)
    {
        logger()->channel('stack')->info('se ha creado un usuario', [
            'name' => $user->name
        ]);
    }

    public function updated($user)
    {
        logger()->channel('stack')->info('se ha editado un usuario', [
            'name' => $user->name
        ]);
    }
}
