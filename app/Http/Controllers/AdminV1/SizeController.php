<?php

namespace App\Http\Controllers\AdminV1;

use App\Contracts\SizesContract;
use App\Entities\Size;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SizeController extends Controller
{
    protected $sizes;

    /**
     * SizeController constructor.
     * @param SizesContract $sizes
     */
    public function __construct(SizesContract $sizes)
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

        $sizes = Size::all(['id', 'name']);

        return view('sizes.index', [
            'sizes' => $sizes,
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
