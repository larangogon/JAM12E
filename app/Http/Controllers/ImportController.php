<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportRequest;
use App\Imports\ProductsImport;
use App\Imports\UsersImport;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

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
    public function importProducts(importRequest $request)
    {
        $file = $request->file('file')->store('import');

        $import = new ProductsImport;
        $import->import($file);

        if($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }

        return back()->with('success', 'All good,
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
