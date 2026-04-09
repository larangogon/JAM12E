<?php

namespace App\Http\Controllers\AdminV1;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class WeController extends Controller
{
    /**
     * WeController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('Status');
        $this->middleware('verified');
    }

    /**
     * @return View
     */
    public function index(): View
    {
        return view('nosotros.index');
    }

    /**
     * @return View
     */
    public function indexApi(): View
    {
        return view('nosotros.indexApi');
    }
}
