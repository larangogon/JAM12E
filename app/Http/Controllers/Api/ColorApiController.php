<?php

namespace App\Http\Controllers\Api;

use App\Entities\Color;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ColorApiController extends Controller
{
    /**
     * ColorApiController constructor.
     */
    public function __construct()
    {
        $this->middleware('role:Administrator');
    }

    /**
     * @OA\Get(
     *      path="/auth/color",
     *      operationId="index",
     *      tags={"Colors all"},
     *      summary="Get list of colors",
     *      security={
     *      {"passport": {*}},
     *      },
     *      description="Returns list of colors",
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
        $colors = Color::all(['id','name']);

        return response()
            ->json([
                'lista de colores', $colors
            ], 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $color = Color::create($request->all());

        return response()
            ->json([
            'status' => ($color) ? 'created' : 'failed'
            ], 200);
    }
}
