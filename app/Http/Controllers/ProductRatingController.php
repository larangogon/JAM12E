<?php

namespace App\Http\Controllers;

use App\Entities\Product;
use App\Entities\User;
use App\Http\Requests\ScoreRequest;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;

class ProductRatingController extends Controller
{
    /**
     * @param Product $product
     * @param ScoreRequest $request
     * @var User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function rate(Product $product, ScoreRequest $request)
    {
        $user = $request->user();
        $user->rate($product, $request->get('score'));

        new ProductResource($product);

        return redirect()->back()
            ->with('success', 'Producto Calificado correctamente');
    }

    /**
     * @param Product $product
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @var User $user
     */
    public function unrate(Product $product, Request $request)
    {
        $user = $request->user();
        $user->unrate($product);

        new ProductResource($product);

        return redirect()->back()
        ->with('success', 'Producto Calificado correctamente');
    }
}
