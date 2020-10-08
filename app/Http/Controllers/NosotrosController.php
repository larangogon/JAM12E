<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class NosotrosController extends Controller
{
    /**
     * NosotrosController constructor.
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
    public function index() : View
    {
        return view('nosotros.index');
    }
}
