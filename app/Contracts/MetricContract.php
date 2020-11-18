<?php

namespace App\Contracts;

use Illuminate\Support\Collection;

interface MetricContract
{
    /**
     * @param array $filters
     * @return Collection
     */
    public function read(array $filters): Collection;
}
