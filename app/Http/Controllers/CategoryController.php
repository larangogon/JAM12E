<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Interfaces\InterfaceCategories;

class CategoryController extends Controller
{
    protected $categories;

    public function __construct(InterfaceCategories $categories)
    {
        $this->middleware('auth');
        $this->middleware('verified');
        $this->middleware('Status');
        $this->categories = $categories;
    }

    /**
     * @return View
     */
    public function index(): View
    {
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
        $this->categories->store($request);

        return redirect('categories');
    }
}
