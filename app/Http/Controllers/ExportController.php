<?php

namespace App\Http\Controllers;

use App\Exports\OrdersExport;
use App\Exports\ProductsExport;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExportController extends Controller
{
    /**
     * ExportController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('Status');
        $this->middleware('verified');
        $this->middleware('role:Administrator');
    }

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
        return Excel::download(new ProductsExport, 'products.xlsx');
    }

    /**
     * @return BinaryFileResponse
     */
    public function exportOrders(): BinaryFileResponse
    {
        return Excel::download(new OrdersExport, 'orders.xlsx');
    }
}
