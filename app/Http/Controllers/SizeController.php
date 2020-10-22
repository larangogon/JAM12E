<?php

namespace App\Http\Controllers;

use App\Entities\Size;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Interfaces\InterfaceSizes;
use Illuminate\Http\RedirectResponse;

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
        $this->middleware('role:Administrator');
    }

    /**
     * @return View
     */
    public function index(): View
    {
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
        $this->sizes->store($request);

        return redirect('sizes');
    }
}
