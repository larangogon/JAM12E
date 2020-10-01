<?php

namespace App\Http\Controllers;

use App\Size;
use App\Color;
use App\Product;
use Illuminate\View\View;
use Illuminate\Http\Request;

class VitrinaController extends Controller
{
    protected $products;

    /**
     * @param Product $products
     */
    public function __construct(Product $products)
    {
        $this->middleware('auth');
        $this->middleware('Status');
        $this->middleware('verified');
        $this->$products = $products;
    }

    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $category = $request->get('category', null);
        $search   = $request->get('search', null);

        $this->products = new Product();

        return view('vitrina/index', [
            'search'   => $search,
            'products' => $this->products
                ->category($category)
                ->active()
                ->search($search)
                ->paginate(20)
        ]);
    }

    /**
     * @param integer $id
     * @return View
     */
    public function show(int $id): View
    {
        $products = Product::active()
            ->where('id', '=', $id)
            ->firstOrFail();

        return view('vitrina/show', compact('products'));
    }
}
