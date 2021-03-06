<?php

namespace App\Http\Controllers\AdminV1;

use App\Entities\Product;
use App\Entities\Rating;
use App\Http\Controllers\Controller;
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
        $rating = Rating::topRating()->get();

        $visit  = Product::orderBy('visits', 'desc')
            ->take(4)->get(['name', 'id','price', 'visits']);

        $sales = Product::orderBy('sales', 'desc')
            ->take(4)->get(['name', 'id', 'sales','price']);

        return view('home', [
            'rating' => $rating,
            'visit'  => $visit,
            'sales'  => $sales,
            'cart'   => Auth::user()->cart
        ]);
    }
}
