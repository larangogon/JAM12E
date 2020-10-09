<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ItemCreateRequest;
use App\Http\Requests\ItemUpdateRequest;
use App\Product;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    /**
     * ProductController constructor.
     */
    public function __construct()
    {
        $this->middleware('Status');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        $products = Product::all(['id','name', 'description', 'price', 'stock']);

        foreach ($products as $product) {
            $product->colors;
            $product->sizes;
            $product->categories;
            $product->imagenes;
        }

        return response()->json(['lista de procustos', $products], 200);
    }

    /**
     * @param ItemCreateRequest $request
     * @return JsonResponse
     */
    public function store(ItemCreateRequest $request): JsonResponse
    {
        $product = Product::create($request->all());

        $product->asignarColor($request->get('color'));
        $product->asignarCategory($request->get('category'));
        $product->asignarSize($request->get('size'));

        $files = $request->file('img');
        $product->asignarImagen($files, $product->id);


        return response()->json([
            'status' => ($product) ? 'created' : 'failed'
        ], 200);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $product = Product::find($id, [
            'id','name', 'description', 'price', 'stock'
        ]);

        if (!$product) {
            return response()
                ->json('no se encontro el producto con este id', 404);
        }

        $product->colors;
        $product->categories;
        $product->sizes;
        $product->imagenes;


        return response()->json(['Produto', $product], 200);
    }

    /**
     * @param ItemUpdateRequest $request
     * @param Product $product
     * @return JsonResponse
     */
    public function update(ItemUpdateRequest $request, Product $product): JsonResponse
    {
        $product->update($request->all());

        if (!$product) {
            return response()
                ->json('no se encontro el producto con este id', 404);
        }

        $product->colors()->sync($request->get('color'));
        $product->categories()->sync($request->get('category'));
        $product->sizes()->sync($request->get('size'));

        $files = $request->file('img');
        $product->asignarImagen($files, $product->id);

        return response()->json([
            'status' => ($product) ? 'updated' : 'failed'
        ], 200);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $product = Product::destroy($id);

        if (!$product) {
            return response()
                ->json('no se encontro el producto con este id', 404);
        }

        return response()->json([
            'status' => ($product) ? 'deleted' : 'failed'
        ]);
    }
}
