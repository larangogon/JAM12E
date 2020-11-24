<?php

namespace App\Http\Controllers;

use App\Entities\Detail;
use App\Entities\Order;
use App\Entities\Product;
use App\Entities\Rating;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tests\Unit\RatingTest;

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
