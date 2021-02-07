<?php

namespace App\Http\Controllers\AdminV1;

use App\Entities\Color;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Interfaces\InterfaceColors;
use Illuminate\Http\RedirectResponse;

class ColorController extends Controller
{
    protected $colors;

    /**
     * ColorController constructor.
     * @param InterfaceColors $colors
     */
    public function __construct(InterfaceColors $colors)
    {
        $this->colors = $colors;
        $this->middleware('auth');
        $this->middleware('verified');
        $this->middleware('Status');
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $this->authorize('color.index');

        $colors = Color::all(['id','name']);

        return view('colors.index', ['colors' => $colors]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $this->authorize('color.store');

        $this->colors->store($request);

        return redirect('colors');
    }
}
