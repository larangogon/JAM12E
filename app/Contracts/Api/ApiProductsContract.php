<?php

namespace App\Contracts\Api;

use App\Http\Requests\ApiStoreRequest;
use App\Http\Requests\ApiUpdateRequest;

interface ApiProductsContract
{
    public function store(ApiStoreRequest $request);
    public function update(ApiUpdateRequest $request, int $id);
    public function destroy(int $id);
}
