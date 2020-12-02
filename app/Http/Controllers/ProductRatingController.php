<?php

namespace App\Http\Controllers;

use App\Entities\Product;
use App\Entities\User;
use App\Http\Requests\ScoreRequest;
use App\Http\Resources\ProductResource;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProductRatingController extends Controller
{
    /**
     * @param Product $product
     * @param ScoreRequest $request
     * @return RedirectResponse
     */
    public function rate(Product $product, ScoreRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->rate($product, $request->get('score'));

        new ProductResource($product);

        return redirect()->back()
            ->with('success', 'Producto calificado correctamente');
    }

    /**
     * @param Product $product
     * @param Request $request
     * @return RedirectResponse
     */
    public function unrate(Product $product, Request $request): RedirectResponse
    {
        $user = $request->user();
        $user->unrate($product);

        new ProductResource($product);

        return redirect()->back()
        ->with('success', 'Producto calificado correctamente');
    }
}
