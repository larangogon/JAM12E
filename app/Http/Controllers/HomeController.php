<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * HomeController constructor.
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
        return view('home', ['cart' => Auth::user()->cart]);
    }
}
