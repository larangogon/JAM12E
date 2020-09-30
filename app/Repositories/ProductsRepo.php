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
        $products= new Product();

        $products->name        = $request->name;
        $products->description = $request->description;
        $products->price       = $request->price;
        $products->stock       = $request->stock;

        $products->save();

        $products->asignarColor($request->get('color'));
        $products->asignarCategory($request->get('category'));
        $products->asignarSize($request->get('size'));

        $files = $request->file('img');
        $products->asignarImagen($files, $products->id);
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

        if ($request->get('category', null)) {
            $category = $product->categories;

            if (count($category)> 0) {
                $category_id = $category[0]->id;
            }
            $product->categories()->updateExistingPivot($category_id, ['category_id' => $request->get('category')]);
        }

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
        $products = Product::find($id);

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
