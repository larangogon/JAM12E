<?php

namespace App\Decorators;

use App\Contracts\UsersContract;
use App\Entities\User;
use App\Http\Requests\UserEditFormRequest;
use App\Http\Requests\UserFormRequest;
use App\Repositories\UsersContractRepo;
use Illuminate\Support\Facades\Cache;

class DecoratorUser implements UsersContract
{
    public function __construct(public readonly UsersContractRepo $usersRepo)
    {
    }

    public function store(UserFormRequest $request): void
    {
        $this->usersRepo->store($request);

        Cache::tags('users')->flush();
    }

    public function update(UserEditFormRequest $request, User $user): void
    {
        $this->usersRepo->update($request, $user);

        Cache::tags('users')->flush();
    }

    public function active(User $user): void
    {
        $this->usersRepo->active($user);

        Cache::tags('users')->flush();
    }
}
