<?php

namespace App\Http\Controllers\AdminV1;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class AboutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('Status');
        $this->middleware('verified');
    }

    public function index(): View
    {
        return view('about.index');
    }

    public function indexApi(): View
    {
        return view('about.api');
    }
}
