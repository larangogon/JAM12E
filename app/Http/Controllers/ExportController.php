<?php

namespace App\Http\Controllers;

use App\Exports\OrdersExport;
use App\Exports\ProdustsExport;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExportController extends Controller
{
    /**
     * @return BinaryFileResponse
     */
    public function exportUsers(): BinaryFileResponse
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    /**
     * @return BinaryFileResponse
     */
    public function exportProducts(): BinaryFileResponse
    {
        return Excel::download(new ProdustsExport, 'products.xlsx');
    }

    /**
     * @return BinaryFileResponse
     */
    public function exportOrders(): BinaryFileResponse
    {
        return Excel::download(new OrdersExport, 'orders.xlsx');
    }
}
