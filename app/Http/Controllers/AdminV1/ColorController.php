<?php

namespace App\Http\Controllers\AdminV1;

use App\Contracts\ColorsContract;
use App\Entities\Color;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ColorController extends Controller
{
    protected $colors;

    /**
     * ColorController constructor.
     * @param ColorsContract $colors
     */
    public function __construct(ColorsContract $colors)
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

        $colors = Color::all(['id', 'name']);

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
