<?php

namespace App\Interfaces;

use App\Http\Requests\UserEditFormRequest;

interface InterfaceUsers
{
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
