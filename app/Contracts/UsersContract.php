<?php

namespace App\Contracts;

use App\Entities\User;
use App\Http\Requests\UserEditFormRequest;
use App\Http\Requests\UserFormRequest;

interface UsersContract
{
    public function store(UserFormRequest $request);
    public function update(UserEditFormRequest $request, User $user);
    public function active(User $user);
}
