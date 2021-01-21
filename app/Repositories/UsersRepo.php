<?php

namespace App\Repositories;

use App\Http\Requests\UserFormRequest;
use App\Entities\User;
use App\Interfaces\InterfaceUsers;
use App\Http\Requests\UserEditFormRequest;

class UsersRepo implements InterfaceUsers
{
    /**
     * @param UserFormRequest $request
     * @return mixed|void
     */
    public function store(UserFormRequest $request)
    {
        $user = new User();

        $user->name              = request('name');
        $user->email             = request('email');
        $user->phone             = request('phone');
        $user->cellphone         = request('cellphone');
        $user->address           = request('address');
        $user->document          = request('document');
        $user->password          = bcrypt(request('password'));
        $user->email_verified_at = now();

        $user->save();

        $user->asignarRol($request->get('rol'));
    }

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
