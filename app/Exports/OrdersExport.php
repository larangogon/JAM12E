<?php

namespace App\Exports;

use App\Order;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class OrdersExport implements FromQuery
{
    use Exportable;

    public function query()
    {
        return Order::query()->where('status', 'APPROVED');
    }
}
