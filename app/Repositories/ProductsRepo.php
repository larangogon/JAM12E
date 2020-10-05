<?php

namespace App\Repositories;

use App\Imagen;
use App\Product;
use App\Interfaces\InterfaceProducts;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ItemCreateRequest;
use App\Http\Requests\ItemUpdateRequest;

class ProductsRepo implements InterfaceProducts
{
    /**
     * @param ItemCreateRequest $request
     * @return mixed|void
     */
    public function store(ItemCreateRequest $request): Void
    {
        $product = Product::create($request->all());

        $product->asignarColor($request->get('color'));
        $product->asignarCategory($request->get('category'));
        $product->asignarSize($request->get('size'));

        $files = $request->file('img');
        $product->asignarImagen($files, $product->id);
    }

    /**
     * @param ItemUpdateRequest $request
     * @param Product $product
     * @return mixed|void
     */
    public function update(ItemUpdateRequest $request, Product $product): Void
    {
        $product->update($request->all());

        $product->colors()->sync($request->get('color'));

        $product->categories()->sync($request->get('category'));

        $product->sizes()->sync($request->get('size'));

        $files = $request->file('img');
        $product->asignarImagen($files, $product->id);
    }

    /**
     * @param int $id
     * @return mixed|void
     */
    public function destroy(int $id): Void
    {
        Product::destroy($id);
    }

    /**
     * @param int $imagen_id
     * @param int $product_id
     * @return mixed|void
     */
    public function destroyimagen(int $imagen_id, int $product_id): Void
    {
        $imagen = Imagen::find($imagen_id);

        Storage::delete(public_path('uploads/') . $imagen->name);

        $imagen->delete();
    }

    /**
     * @param int $id
     * @return mixed|void
     */
    public function active(int $id): Void
    {
        $products = Product::findOrFail($id);

        $state = $products->active;
        $products->active = !$state;

        $products->update();
    }
}
