<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ItemCreateRequest;
use App\Http\Requests\ItemUpdateRequest;
use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('Status');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all(['id','name', 'description', 'price', 'stock']);

        foreach ($products as $product) {
            $product->colors;
            $product->sizes;
            $product->categories;
            $product->imagenes;
        }

        return response()->json(['lista de procustos', $products],  200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemCreateRequest $request)
    {
        $product = Product::create($request->all());

        $product->asignarColor($request->get('color'));
        $product->asignarCategory($request->get('category'));
        $product->asignarSize($request->get('size'));

        $files = $request->file('img');
        $product->asignarImagen($files, $product->id);


        return response()->json([
            'status' => ($product) ? 'created' : 'failed'
        ],  200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id,[
            'id','name', 'description', 'price', 'stock'
        ]);

        if(!$product){
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ItemUpdateRequest $request, Product $product)
    {
        $product->update($request->all());

        if(!$product){
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
        ],  200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::destroy($id);

        if(!$product){
            return response()
                ->json('no se encontro el producto con este id', 404);
        }

        return response()->json([
            'status' => ($product) ? 'deleted' : 'failed'
        ]);
    }
}
