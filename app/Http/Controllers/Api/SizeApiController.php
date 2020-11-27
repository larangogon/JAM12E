<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Entities\Size;
use Illuminate\Http\Request;

class SizeApiController extends Controller
{
    /**
     * SizeApiController constructor.
     */
    public function __construct()
    {
        $this->middleware('role:Administrator');
    }

    /**
     * @OA\Get(
     *      path="/api/auth/size",
     *      operationId="index",
     *      tags={"Sizes all"},
     *      summary="Get list of sizes",
     *      security={
     *      {"passport": {*}},
     *      },
     *      description="Returns list of sizes",
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
        $sizes = Size::all([
            'id','name'
        ]);

        return response()
            ->json([
                'lista de colores', $sizes
            ], 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $size = Size::create($request->all());

        return response()
            ->json([
                'status' => ($size) ? 'created' : 'failed'
            ], 200);
    }
}
