<?php

namespace App\Http\Controllers;

use App\Exports\OrdersExport;
use App\Exports\ProdustsExport;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportUsers()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportProducts()
    {
        return Excel::download(new ProdustsExport, 'products.xlsx');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportOrders()
    {
        return Excel::download(new OrdersExport, 'orders.xlsx');
    }
}
