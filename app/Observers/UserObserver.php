<?php

namespace App\Observers;

class UserObserver
{
    public function created($user)
    {
        logger()->info('se ha creado un usuario', ['name' => $user->name]);
    }

    public function updated($user)
    {
        logger()->info('se ha editado un usuario', ['name' => $user->name]);
    }
}
