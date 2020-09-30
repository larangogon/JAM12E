<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Interfaces\InterfaceRoles;

class RolesRepo implements InterfaceRoles
{
    /**
     * @param Request $request
     * @return mixed|void
     */
    public function store(Request $request): Void
    {
        //
    }
}
