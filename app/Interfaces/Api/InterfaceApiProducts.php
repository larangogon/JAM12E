<?php

namespace App\Interfaces\Api;

use App\Http\Requests\ApiStoreRequest;
use App\Http\Requests\ApiUpdateRequest;

interface InterfaceApiProducts
{
    /**
     * @param ApiStoreRequest $request
     * @return mixed
     */
    public function store(ApiStoreRequest $request);

    /**
     * @param ApiUpdateRequest $request
     * @param int $id
     * @return mixed
     */
    public function update(ApiUpdateRequest $request, int $id);

    /**
     * @param int $id
     * @return mixed
     */
    public function destroy(int $id);
}
