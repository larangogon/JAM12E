<?php

namespace App\Http\Controllers\AdminV1;

use App\Entities\Size;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Interfaces\InterfaceSizes;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;

class SizeController extends Controller
{
    protected $sizes;

    /**
     * SizeController constructor.
     * @param InterfaceSizes $sizes
     */
    public function __construct(InterfaceSizes $sizes)
    {
        $this->sizes = $sizes;
        $this->middleware('auth');
        $this->middleware('verified');
        $this->middleware('Status');
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $this->authorize('size.index');

        $sizes = Size::all(['id','name']);

        return view('sizes.index', [
            'sizes' => $sizes
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $this->authorize('size.store');

        $this->sizes->store($request);

        return redirect('sizes');
    }
}
