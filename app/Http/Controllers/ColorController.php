<?php

namespace App\Http\Controllers;

use App\Color;
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
        $this->middleware('auth');
        $this->middleware('verified');
        $this->middleware('Status');
        $this->colors = $colors;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $colors = Color::all();

        return view('colors.index', ['colors' => $colors]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $this->colors->store($request);

        return redirect('colors');
    }
}
