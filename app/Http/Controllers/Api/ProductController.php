<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiStoreRequest;
use App\Http\Requests\ApiUpdateRequest;
use App\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * ProductController constructor.
     */
    public function __construct()
    {
        //
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $query    = trim($request->get('search'));
        $products = Product::where('name', 'LIKE', '%' . $query . '%')
            ->orwhere('id', 'LIKE', '%' . $query . '%')
            ->orderBy('id', 'asc')
            ->paginate(2);

        foreach ($products as $product) {
            $product->colors;
            $product->sizes;
            $product->categories;
            $product->imagenes;
        }

        return response()->json(['lista de procustos', $products, 'search',$query], 200);
    }

    /**
     * @param ApiStoreRequest $request
     * @return JsonResponse
     */
    public function store(ApiStoreRequest $request): JsonResponse
    {
        if (!$request) {
            return response()
                ->json('faltan datos', 422);
        }
        $product = Product::create($request->all());

        $product->asignarColor($request->get('color'));
        $product->asignarCategory($request->get('category'));
        $product->asignarSize($request->get('size'));

        $files = $request->file('img');
        $product->asignarImagen($files, $product->id);



        return response()->json([
            'status' => ($product) ? 'created' : 'failed',[
                'productoId'  => $product->id,
                'name'        => $product->name,
                'price'       => $product->price,
                'stock'       => $product->stock,
                'description' => $product->description,
                'color'       => $product->colors,
                'category'    => $product->categories,
                'size'        => $product->sizes
            ]
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
     * @param ApiUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(ApiUpdateRequest $request, int $id): JsonResponse
    {
        $product = Product::find($id);

        if (!$product) {
            return response()
                ->json('no se encontro el producto con este id', 404);
        }

        $product->update($request->all());

        $product->colors()->sync($request->get('color'));
        $product->categories()->sync($request->get('category'));
        $product->sizes()->sync($request->get('size'));

        $files = $request->file('img');
        $product->asignarImagen($files, $product->id);

        return response()->json([
            'status' => ($product) ? 'updated' : 'failed',[
                'productoId'  => $product->id,
                'name'        => $product->name,
                'price'       => $product->price,
                'stock'       => $product->stock,
                'description' => $product->description,
                'color'       => $product->colors,
                'category'    => $product->categories,
                'size'        => $product->sizes
            ]
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
            'status' => ($product) ? 'deleted' : 'failed',
                'se ha eliminado el producto exitosamente'
        ]);
    }
}
