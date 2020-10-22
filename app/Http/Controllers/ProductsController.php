<?php

namespace App\Http\Controllers;

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
        $this->middleware('role:Guest');

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
            ->with('success', 'producto Creado Satisfactoriamente');
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

        return redirect('/products')
            ->with('success', 'producto Editado Satisfactoriamente');
    }

    /**
     * @param integer $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $this->products->destroy($id);

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
        $this->products->destroyimagen($id, $product);

        return redirect()->back()
            ->with('success', 'Imagen Eliminada Satisfactoriamente !');
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
