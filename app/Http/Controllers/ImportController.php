<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportRequest;
use App\Imports\ProductsImport;
use App\Imports\UsersImport;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    /**
     * ImportController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('Status');
        $this->middleware('verified');
        $this->middleware('role:Administrator');
    }

    /**
     * @param ImportRequest $request
     * @return RedirectResponse
     */
    public function import(importRequest $request): RedirectResponse
    {
        Excel::import(new UsersImport, $request->file('file'));

        return redirect('users')->with('success', 'All good!');
    }

    /**
     * @return View
     */
    public function index(): View
    {
        return view('imports.index');
    }

    /**
     * @param ImportRequest $request
     * @return RedirectResponse
     */
    public function importProducts(importRequest $request): RedirectResponse
    {
        Excel::import(new ProductsImport, $request->file('file'));

        return redirect('products')->with('success', 'All good,
        import of products successfully!');
    }


    /**
     * @return View
     */
    public function indexProducts(): View
    {
        return view('imports.indexProducts');
    }
}
