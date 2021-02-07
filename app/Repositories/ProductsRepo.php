<?php

namespace App\Repositories;

use App\Entities\Imagen;
use App\Entities\Product;
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
    public function store(ItemCreateRequest $request): void
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
     */
    public function update(ItemUpdateRequest $request, Product $product): void
    {
        $product->update($request->all());

        $product->colors()->sync($request->get('color'));
        $product->categories()->sync($request->get('category'));
        $product->sizes()->sync($request->get('size'));

        $files = $request->file('img');
        $product->asignarImagen($files, $product->id);
    }

    /**
     * @param Product $product
     */
    public function destroy(Product $product): void
    {
        $product->destroy($product->id);
    }

    /**
     * @param int $id
     * @param Product $product
     */
    public function destroyimagen(int $id, Product $product): void
    {
        $imagen = Imagen::find($id);

        Storage::delete(public_path('uploads/') . $imagen->name);

        $imagen->delete();
    }

    /**
     * @param Product $product
     */
    public function active(Product $product): void
    {;
        $state = $product->active;
        $product->active = !$state;

        $product->update();
    }
}
