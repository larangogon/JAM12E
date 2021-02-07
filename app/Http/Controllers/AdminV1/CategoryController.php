<?php

namespace App\Http\Controllers\AdminV1;

use App\Entities\Category;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Interfaces\InterfaceCategories;

class CategoryController extends Controller
{
    protected $categories;

    /**
     * CategoryController constructor.
     * @param InterfaceCategories $categories
     */
    public function __construct(InterfaceCategories $categories)
    {
        $this->categories = $categories;
        $this->middleware('auth');
        $this->middleware('verified');
        $this->middleware('Status');
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $this->authorize('category.index');

        $categories = Category::all(['id','name']);

        return view('categories.index', [
            'categories' => $categories
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $this->authorize('category.store');

        $this->categories->store($request);

        return redirect('categories');
    }
}
