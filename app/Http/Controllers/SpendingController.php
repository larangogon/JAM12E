<?php

namespace App\Http\Controllers;

use App\Entities\Spending;
use App\Http\Requests\RequestStoreSpending;
use App\Http\Requests\RequestUpdateSpending;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SpendingController extends Controller
{
    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        if ($request) {
            $query = trim($request->get('search'));
        }

        $spendings = Spending::where('created_by', 'LIKE', '%' . $query . '%')
            ->orderBy('id', 'asc')
            ->paginate(15);

        return view('spendings.index', [
            'spendings' => $spendings,
            'search'   => $query
        ]);
    }

    /**
     * @return View
     */
    public function create()
    {
        return view('spendings.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(RequestStoreSpending $request): RedirectResponse
    {
        $spending = Spending::create($request->all());

        return redirect('/spendings')
            ->with('success', 'Creado Satisfactoriamente');
    }

    /**
     * @param int $id
     * @return View
     */
    public function show(int $id)
    {
        $spending = Spending::where('id', '=', $id)->firstOrFail();

        return view('spendings.show', compact('spending'));
    }

    /**
     * @param int $id
     * @return View
     */
    public function edit(int $id)
    {
        $spending  = Spending::findOrFail($id);

        return view('spendings.edit', ['spending' => $spending]);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(RequestUpdateSpending $request, int $id): RedirectResponse
    {
        $spending = Spending::findOrFail($id);
        $spending->update($request->all());

        return redirect('spendings')
            ->with('success', 'Editado Satisfactoriamente');
    }

    /**
     * @param int $id
     */
    public function destroy(int $id)
    {
        Spending::destroy($id);
        return redirect('spendings')
            ->with('success', 'Eliminado Satisfactoriamente');

    }
}
