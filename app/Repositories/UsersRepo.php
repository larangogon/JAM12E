<?php

namespace App\Repositories;

use App\Cart;
use App\Http\Requests\UserFormRequest;
use App\User;
use App\Interfaces\InterfaceUsers;
use App\Http\Requests\UserEditFormRequest;
use Illuminate\Http\RedirectResponse;

class UsersRepo implements InterfaceUsers
{
    /**
     * @param UserFormRequest $request
     * @return mixed|void
     */
    public function store(UserFormRequest $request)
    {
        $user = User::create($request->all());

        $user->asignarRol($request->get('rol'));

        $this->cart = new Cart();

        $this->cart->user_id = $user->id;
        $this->cart->save();
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
