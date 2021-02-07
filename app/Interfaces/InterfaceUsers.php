<?php

namespace App\Interfaces;

use App\Entities\User;
use App\Http\Requests\UserEditFormRequest;
use App\Http\Requests\UserFormRequest;

interface InterfaceUsers
{
    /**
     * @param UserFormRequest $request
     * @return mixed
     */
    public function store(UserFormRequest $request);

    /**
     * @param UserEditFormRequest $request
     * @param User $user
     * @return mixed
     */
    public function update(UserEditFormRequest $request, User $user);

    /**
     * @param User $user
     * @return mixed
     */
    public function active(User $user);
}
