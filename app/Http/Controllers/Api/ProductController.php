<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiStoreRequest;
use App\Http\Requests\ApiUpdateRequest;
use App\Interfaces\Api\InterfaceApiProducts;
use App\Entities\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $products;

    /**
     * ProductsController constructor.
     * @param InterfaceApiProducts $products
     */
    public function __construct(InterfaceApiProducts $products)
    {
        $this->products = $products;
        $this->middleware('role:Administrator');
    }

    /**
     * @param Request $request
     * @return JsonResponse
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

        return response()
            ->json([
                'lista de procustos', $products, 'search',$query
            ], 200);
    }

    /**
     * @param ApiStoreRequest $request
     * @return JsonResponse
     */
    public function store(ApiStoreRequest $request): JsonResponse
    {
        $this->products->store($request);

        if (!'product') {
            return response()
                ->json('failed', 200);
        }

        return response()->json([
            'status' => 'created'
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

        return response()
            ->json([
                'Produto', $product
            ], 200);
    }

    /**
     * @param ApiUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(ApiUpdateRequest $request, int $id): JsonResponse
    {
        $product = Product::find($id);

        $this->products->update($request, $id);

        if (!$product) {
            return response()
                ->json('no se encontro el producto con este id', 404);
        }

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

        return response()
            ->json([
                'status' => ($product) ? 'deleted' : 'failed'
        ]);
    }
}
