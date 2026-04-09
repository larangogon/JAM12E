<?php

namespace App\Metrics;

use App\Contracts\MetricContract;
use Illuminate\Support\Collection;

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
