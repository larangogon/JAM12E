<?php

namespace App\Http\Controllers\AdminV1;

use App\Http\Requests\ImportImgsRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\ProductsImport;
use App\Imports\UsersImport;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Controllers\Controller;

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
    }

    /**
     * @param ImportRequest $request
     * @return RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function import(importRequest $request): RedirectResponse
    {
        $this->authorize('import.user');

        $file = $request->file('file')->store('import');

        $import = new UsersImport();

        $import->import($file);

        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }

        return back()
            ->with('success', '¡Todo bien, importación de usuarios con éxito!');
    }

    /**
     * @return View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(): View
    {
        $this->authorize('index.importUser');
        return view('imports.index');
    }

    /**
     * @param ImportRequest $request
     * @return RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function importProducts(importRequest $request)
    {
        $this->authorize('product.import');

        $file = $request->file('file')->store('import');

        $import = new ProductsImport();

        $import->import($file);

        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }

        return back()
            ->with('success', '¡Todo bien, importación de productos con éxito!');
    }

    /**
     * @return View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function indexProducts(): View
    {
        $this->authorize('index.importProduct');

        return view('imports.indexProducts');
    }

    /**
     * @param ImportImgsRequest $request
     * @return RedirectResponse|void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function imgsProducts(ImportImgsRequest $request)
    {
        $this->authorize('imgs.import');

        $files = $request->file('imgUp');

        if (!$files) {
            return;
        }
        foreach ($files as $file) {
            $name = $file->getClientOriginalName();
            $file->move(public_path() . '/uploads/', $name);
        }

        return back()
            ->with('success', '¡Todo bien, importación de imagenes con éxito!!');
    }
}
