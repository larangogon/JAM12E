<?php

namespace App\Http\Controllers\Api;

use App\Color;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ColorApiController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $colors = Color::all(['id','name']);

        return response()->json(['lista de colores', $colors], 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $color = Color::create($request->all());

        return response()->json([
            'status' => ($color) ? 'created' : 'failed'], 200);
    }
}
