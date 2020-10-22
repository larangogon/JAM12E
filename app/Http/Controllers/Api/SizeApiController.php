<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Entities\Size;
use Illuminate\Http\Request;

class SizeApiController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $sizes = Size::all(['id','name']);

        return response()->json(['lista de colores', $sizes], 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $size = Size::create($request->all());

        return response()->json([
            'status' => ($size) ? 'created' : 'failed'], 200);
    }
}
