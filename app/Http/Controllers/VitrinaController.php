<?php

namespace App\Http\Controllers;

use App\Entities\Product;
use App\Entities\Rating;
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
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|View
     */
    public function show(int $id)
    {
        $product = Product::active()
            ->where('id', '=', $id)
            ->firstOrFail();

        $product->visits += 1;

        $product->save();

        $ratin = Rating::all()
            ->where('rateable_id', '=', $id);

        $total = $ratin->sum('score');
        $promedio = $ratin->count('qualifiqier_type');

        if ($total) {
            $promediox = $total / $promedio;
        } else {
            $promediox = $total;
        }

        return view('vitrina/show', [
            'product'   => $product,
            'promedio'  => $promedio,
            'total'     => $total,
            'promediox' => $promediox
        ]);
    }
}
