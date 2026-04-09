<?php

namespace App\Repositories;

use App\Contracts\UsersContract;
use App\Entities\User;
use App\Http\Requests\UserEditFormRequest;
use App\Http\Requests\UserFormRequest;

class UsersContractRepo implements UsersContract
{
    /**
     * @param UserFormRequest $request
     * @return mixed|void
     */
    public function store(UserFormRequest $request)
    {
        $user = new User();

        $user->name = request('name');
        $user->email = request('email');
        $user->phone = request('phone');
        $user->cellphone = request('cellphone');
        $user->address = request('address');
        $user->document = request('document');
        $user->password = bcrypt(request('password'));
        $user->email_verified_at = now();

        $user->save();

        $user->asignarRol($request->get('rol'));
    }

    /**
     * @param UserEditFormRequest $request
     * @param User $user
     */
    public function update(UserEditFormRequest $request, User $user): void
    {
        $user->update($request->all());

        $user->roles()->sync($request->get('rol'));
    }

    /**
     * @param User $user
     */
    public function active(User $user): void
    {
        $state = $user->active;
        $user->active = !$state;

        $user->update();
    }
}
