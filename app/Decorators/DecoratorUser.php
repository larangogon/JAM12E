<?php

namespace App\Decorators;

use App\Http\Requests\UserEditFormRequest;
use App\Http\Requests\UserFormRequest;
use App\Repositories\UsersRepo;
use App\Interfaces\InterfaceUsers;
use Illuminate\Support\Facades\Cache;
use App\Entities\User;

class DecoratorUser implements InterfaceUsers
{
    protected $usersRepo;

    /**
     * DecoratorUser constructor.
     * @param UsersRepo $usersRepo
     */
    public function __construct(UsersRepo $usersRepo)
    {
        $this->usersRepo = $usersRepo;
    }

    /**
     * @param UserFormRequest $request
     */
    public function store(UserFormRequest $request)
    {
        $this->usersRepo->store($request);

        Cache::tags('users')->flush();
    }

    /**
     * @param UserEditFormRequest $request
     * @param User $user
     */
    public function update(UserEditFormRequest $request, User $user): void
    {
        $this->usersRepo->update($request, $user);

        Cache::tags('users')->flush();
    }

    /**
     * @param User $user
     */
    public function active(User $user): void
    {
        $this->usersRepo->active($user);

        Cache::tags('users')->flush();
    }
}
