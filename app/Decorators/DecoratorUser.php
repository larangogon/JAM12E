<?php

namespace App\Decorators;

use App\Http\Requests\UserEditFormRequest;
use App\Http\Requests\UserFormRequest;
use App\Repositories\UsersRepo;
use App\Interfaces\InterfaceUsers;
use Illuminate\Support\Facades\Cache;

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
     * @param int $id
     * @return mixed|void
     */
    public function update(UserEditFormRequest $request, int $id): void
    {
        $this->usersRepo->update($request, $id);

        Cache::tags('users')->flush();
    }

    /**
     * @param int $id
     * @return void
     */
    public function active(int $id): void
    {
        $this->usersRepo->active($id);

        Cache::tags('users')->flush();
    }
}
