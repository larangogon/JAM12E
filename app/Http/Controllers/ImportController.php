<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportImgsRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\ProductsImport;
use App\Imports\UsersImport;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
        $file = $request->file('file')->store('import');

        $import = new UsersImport();

        $import->import($file);

        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }

        return back()
            ->with('success', 'All good, import of users successfully!');
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

        $import = new ProductsImport();

        $import->import($file);

        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }

        return back()
            ->with('success', 'All good, import of products successfully!');
    }

    /**
     * @return View
     */
    public function indexProducts(): View
    {
        return view('imports.indexProducts');
    }

    /**
     * @param ImportImgsRequest $request
     * @return RedirectResponse|void
     */
    public function imgsProducts(ImportImgsRequest $request)
    {
        $files = $request->file('imgUp');

        if (!$files) {
            return;
        }
        foreach ($files as $file) {
            $name = $file->getClientOriginalName();
            $file->move(public_path() . '/uploads/', $name);
        }

        return back()->with('success', 'All good,
        import of imgs successfully!');
    }
}
