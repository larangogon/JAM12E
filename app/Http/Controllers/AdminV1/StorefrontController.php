<?php

namespace App\Http\Controllers\AdminV1;

use App\Entities\Product;
use App\Entities\Rating;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StorefrontController extends Controller
{
    protected $products;

    public function __construct(Product $products)
    {
        $this->middleware('auth');
        $this->middleware('Status');
        $this->middleware('verified');
        $this->products = $products;
    }

    public function index(Request $request): View
    {
        $category = $request->get('category', null);
        $search = $request->get('search', null);

        $this->products = new Product();

        return view('storefront.index', [
            'search' => $search,
            'products' => $this->products
                ->category($category)
                ->active()
                ->search($search)
                ->paginate(20),
        ]);
    }

    public function show(int $id): View
    {
        $product = Product::active()
            ->where('id', '=', $id)
            ->firstOrFail();

        $product->visits += 1;

        $product->save();

        $ratings = Rating::all()
            ->where('rateable_id', '=', $id);

        $total = $ratings->sum('score');
        $average = $ratings->count();

        if ($total) {
            $averageScore = $total / $average;
        } else {
            $averageScore = $total;
        }

        return view('storefront.show', [
            'product' => $product,
            'average' => $average,
            'total' => $total,
            'averageScore' => $averageScore,
        ]);
    }
}
