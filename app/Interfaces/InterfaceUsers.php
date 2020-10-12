<?php

namespace App\Interfaces;

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
     * @param int $id
     * @return mixed
     */
    public function update(UserEditFormRequest $request, int $id);

    /**
     * @param int $id
     * @return mixed
     */
    public function active(int $id);
}
