<?php

namespace App\Http\Controllers\AdminV1;

use App\Entities\Spending;
use App\Http\Requests\RequestStoreSpending;
use App\Http\Requests\RequestUpdateSpending;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Controllers\Controller;

class SpendingController extends Controller
{
    /**
     * SpendingController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('Status');
        $this->middleware('verified');
        $this->middleware('role:Administrator');
    }

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
            'search'    => $query
        ]);
    }

    /**
     * @return View
     */
    public function create(): View
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
            ->with('success', 'Creado satisfactoriamente');
    }

    /**
     * @param int $id
     * @return View
     */
    public function show(int $id): View
    {
        $spending = Spending::where('id', '=', $id)->firstOrFail();

        return view('spendings.show', compact('spending'));
    }

    /**
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
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
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        Spending::destroy($id);

        return redirect('spendings')
            ->with('success', 'Eliminado Satisfactoriamente');
    }
}
