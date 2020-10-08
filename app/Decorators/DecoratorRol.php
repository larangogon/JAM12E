<?php


namespace App\Decorators;

use Illuminate\Http\Request;
use App\Repositories\RolesRepo;
use App\Interfaces\InterfaceRoles;
use Illuminate\Support\Facades\Cache;

class DecoratorRol implements InterfaceRoles
{
    protected $rolesRepo;

    /**
     * DecoratorRol constructor.
     * @param RolesRepo $rolesRepo
     */
    public function __construct(RolesRepo $rolesRepo)
    {
        $this->rolesRepo = $rolesRepo;
    }

    /**
     * @param Request $request
     * @return mixed|void
     */
    public function store(Request $request): Void
    {
        $this->rolesRepo->store($request);

        Cache::tags('roles')->flush();
    }
}
