<?php

namespace App\Http\Controllers;

use App\Size;
use App\Color;
use App\Imagen;
use App\Product;
use App\Category;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Interfaces\InterfaceProducts;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\ItemCreateRequest;
use App\Http\Requests\ItemUpdateRequest;

class ProductsController extends Controller
{
    protected $products;

    /**
     * ProductsController constructor.
     * @param InterfaceProducts $products
     */
    public function __construct(InterfaceProducts $products)
    {
        $this->products = $products;
        $this->middleware('auth');
        $this->middleware('role:Administrator');
        $this->middleware('Status');
        $this->middleware('verified');
    }

    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $query    = trim($request->get('search'));
        $products = Product::where('name', 'LIKE', '%' . $query . '%')
                            ->orwhere('stock', 'LIKE', '%' . $query . '%')
                            ->orwhere('id', 'LIKE', '%' . $query . '%')
                            ->orderBy('id', 'asc')
                            ->paginate(5);

        return view('products.index', [
            'products' => $products,
            'search'   => $query
        ]);
    }

    /**
     * @return View
     */
    public function create(): View
    {
        $colors     = Color::all(['id','name']);
        $categories = Category::all(['id','name']);
        $sizes      = Size::all(['id','name']);
        $imagenes   = Imagen::all(['id','name']);

        return view('products.create', [
            'colors'     => $colors,
            'categories' => $categories,
            'sizes'      => $sizes,
            'imagenes'   => $imagenes,
            ]);
    }

    /**
     * @param ItemCreateRequest $request
     * @return RedirectResponse
     */
    public function store(ItemCreateRequest $request): RedirectResponse
    {
        $this->products->store($request);

        return redirect('/products')
            ->with('message', 'Guardado Satisfactoriamente !');
    }

    /**
     * @param integer $id
     * @return view
     */
    public function show(int $id): View
    {
        $products = Product::where('id', '=', $id)->firstOrFail();

        return view('products.show', compact('products'));
    }

    /**
     * @param integer $id
     * @return View
     */
    public function edit(int $id): View
    {
        $products   = Product::find($id);
        $colors     = Color::all(['id','name']);
        $categories = Category::all(['id','name']);
        $sizes      = Size::all(['id','name']);

        return view('products.edit', [
            'products'   => $products,
            'colors'     => $colors,
            'categories' => $categories,
            'sizes'      => $sizes,
            ]);
    }

    /**
     * @param ItemUpdateRequest $request
     * @param Product $product
     * @return RedirectResponse
     */
    public function update(ItemUpdateRequest $request, Product $product): RedirectResponse
    {
        $this->products->update($request, $product);

        Session::flash('message', ' producto Editado Satisfactoriamente !');

        return redirect('/products');
    }

    /**
     * @param integer $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $this->products->destroy($id);

        Session::flash('message', 'Eliminado Satisfactoriamente !');

        return Redirect('/products');
    }

    /**
     * @param int $imagen_id
     * @param int $product_id
     * @return RedirectResponse
     */
    public function destroyimagen(int $imagen_id, int $product_id): RedirectResponse
    {
        $this->products->destroyimagen($imagen_id, $product_id);

        Session::flash('message', 'Imagen Eliminada Satisfactoriamente !');

        return redirect("products/edit/{$product_id}");
    }

    /**
     * @param integer $id
     * @return RedirectResponse
     */
    public function active(int $id): RedirectResponse
    {
        $this->products->active($id);

        Session::flash('message', ' Estatus del producto Editado Satisfactoriamente !');

        return redirect('/products');
    }
}
