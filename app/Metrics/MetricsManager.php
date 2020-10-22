<?php

namespace App\Metrics;

use Illuminate\Support\Collection;
use App\Contracts\MetricContract;

class MetricsManager
{
    private $behaviour;

    public function __construct(MetricContract $behaviour)
    {
        $this->behaviour = $behaviour;
    }

    /**
     * @param array $filters
     * @return Collection
     */
    public function read(array $filters): Collection
    {
        return $this->behaviour->read($filters);
    }
}
