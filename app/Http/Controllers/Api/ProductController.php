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
     * @OA\Get(
     *      path="/api/auth/product",
     *      operationId="index",
     *      tags={"Products all"},
     *      summary="Get list of products",
     *      description="Returns list of products",
     * security={
     *    {"passport": {}},
     *    },
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     * @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     * @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *  )
     */
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
     * @OA\Post (
     *      path="/api/auth/product/",
     *      operationId="store",
     *      tags={"Product store"},
     * security={
     *  {"passport": {}},
     *   },
     *      summary="Create one product",
     *      description="Returns product",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      ),
     *     @OA\Parameter(
     *       name="name",
     *       in="query",
     *       required=true,
     *       @OA\Schema(
     *           type="integer"
     *      )
     *    ),
     *    @OA\Parameter(
     *       name="description",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *    ),
     *    @OA\Parameter(
     *       name="stock",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *    ),
     *    @OA\Parameter(
     *       name="img",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *    @OA\Parameter(
     *      name="price",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *    @OA\Parameter(
     *      name="color",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *    @OA\Parameter(
     *      name="category",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *    @OA\Parameter(
     *      name="size",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *    @OA\Parameter(
     *      name="barcode",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     * @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     * @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *  )
     */
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
     * @OA\Get(
     *      path="/api/auth/product/{id}",
     *      operationId="show",
     *      tags={"Product show"},
     * security={
     *  {"passport": {}},
     *   },
     *      summary="Get one product",
     *      description="Returns product",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     * @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     * @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *  )
     */
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
     * @OA\Put (
     *      path="/api/auth/product/{id}",
     *      operationId="update",
     *      tags={"Product update"},
     * security={
     *  {"passport": {}},
     *   },
     *      summary="Update one product",
     *      description="Returns product update",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      ),
     *     @OA\Parameter(
     *       name="name",
     *       in="query",
     *       required=true,
     *       @OA\Schema(
     *           type="integer"
     *      )
     *    ),
     *    @OA\Parameter(
     *       name="stock",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *    ),
     *    @OA\Parameter(
     *      name="color",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *    @OA\Parameter(
     *      name="category",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *    @OA\Parameter(
     *      name="size",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     * @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     * @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *  )
     */
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
     * @OA\Delete (
     *      path="/api/auth/product/{id}",
     *      operationId="destroy",
     *      tags={"Product destroy"},
     * security={
     *  {"passport": {}},
     *   },
     *      summary="Destroy product",
     *      description="Returns delete product",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     * @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     * @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *  )
     */
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
