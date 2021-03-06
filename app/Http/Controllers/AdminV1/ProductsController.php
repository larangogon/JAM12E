<?php

namespace App\Http\Controllers\AdminV1;

use App\Entities\Size;
use App\Entities\Color;
use App\Entities\Imagen;
use App\Entities\Product;
use App\Entities\Category;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Interfaces\InterfaceProducts;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\ItemCreateRequest;
use App\Http\Requests\ItemUpdateRequest;
use App\Http\Controllers\Controller;

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
        $this->middleware('Status');
        $this->middleware('verified');
    }

    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $this->authorize('product.index');

        $query = trim($request->get('search'));

        $products = Product::where('name', 'LIKE', '%' . $query . '%')
            ->orwhere('stock', 'LIKE', '%' . $query . '%')
            ->orwhere('id', 'LIKE', '%' . $query . '%')
            ->orderBy('id', 'asc')
            ->paginate(15);

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
        $this->authorize('product.create');

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
        $this->authorize('product.store');

        $this->products->store($request);

        return redirect('/products')
            ->with('success', 'producto Creado Satisfactoriamente');
    }

    /**
     * @param Product $product
     * @return View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Product $product): View
    {
        $this->authorize('product.show');

        return view('products.show', compact('product'));
    }

    /**
     * @param Product $product
     * @return View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Product $product): View
    {
        $this->authorize('product.edit');

        $colors     = Color::all(['id','name']);
        $categories = Category::all(['id','name']);
        $sizes      = Size::all(['id','name']);

        return view('products.edit', [
            'product'    => $product,
            'colors'     => $colors,
            'categories' => $categories,
            'sizes'      => $sizes,
            ]);
    }

    /**
     * @param ItemUpdateRequest $request
     * @param Product $product
     * @return RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(ItemUpdateRequest $request, Product $product): RedirectResponse
    {
        $this->authorize('product.update');

        $this->products->update($request, $product);

        return redirect('/products')
            ->with('success', 'Producto Editado Satisfactoriamente');
    }

    /**
     * @param Product $product
     * @return RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Product $product): RedirectResponse
    {
        $this->authorize('product.destroy');
        $this->products->destroy($product);

        return Redirect('/products')
            ->with('success', 'Eliminado Satisfactoriamente !');
    }

    /**
     * @param int $id
     * @param Product $product
     * @return RedirectResponse
     */
    public function destroyimagen(int $id, Product $product): RedirectResponse
    {
        $this->authorize('product.destroy');

        $this->products->destroyimagen($id, $product);

        return redirect()->back()
            ->with('success', 'Imagen Eliminada Satisfactoriamente !');
    }

    /**
     * @param Product $product
     * @return RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function active(Product $product): RedirectResponse
    {
        $this->authorize('product.status');

        $this->products->active($product);

        Session::flash('message', 'Estatus del producto Editado Satisfactoriamente !');

        return redirect('/products');
    }
}
