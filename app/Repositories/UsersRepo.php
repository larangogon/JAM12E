<?php

namespace App\Repositories;

use App\User;
use App\Interfaces\InterfaceUsers;
use App\Http\Requests\UserEditFormRequest;

class UsersRepo implements InterfaceUsers
{
    /**
     * @param UserEditFormRequest $request
     * @param int $id
     * @return mixed|void
     */
    public function update(UserEditFormRequest $request, int $id): void
    {
        $usuario = User::findOrFail($id);

        $usuario->update($request->all());

        User::find($id)->roles()->sync($request->get('rol'));
    }

    /**
     * @param int $id
     * @return mixed|void
     */
    public function active(int $id): void
    {
        $user = User::findOrFail($id);

        $state = $user->active;
        $user->active = !$state;

        $user->update();
    }
}
