<?php

namespace App\Http\Controllers\Api;

use App\Entities\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    /**
     * CategoryApiController constructor.
     */
    public function __construct()
    {
        $this->middleware('role:Administrator');
    }

    /**
     * @OA\Get(
     *      path="/api/auth/category",
     *      operationId="index",
     *      tags={"Category all"},
     *      summary="Get list of categories",
     *      security={
     *      {"passport": {*}},
     *      },
     *      description="Returns list of categories",
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $categories = Category::all(['id','name']);

        return response()
            ->json([
                'lista de categorias', $categories
            ], 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $category = Category::create($request->all());

        return response()
            ->json([
            'status' => ($category) ? 'created' : 'failed'
            ], 200);
    }
}
