<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use App\Cart;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Interfaces\InterfaceUsers;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\UserEditFormRequest;

class UserController extends Controller
{
    protected $users;

    /**
     * UserController constructor.
     * @param InterfaceUsers $users
     */
    public function __construct(InterfaceUsers $users)
    {
        $this->users = $users;
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
        $query = trim($request->get('search'));

        $users = User::where('name', 'LIKE', '%' . $query . '%')
                    ->orwhere('email', 'LIKE', '%' . $query . '%')
                    ->orwhere('id', 'LIKE', '%' . $query . '%')
                    ->orderBy('id', 'asc')
                    ->paginate(6);

        return view('users.index', ['users' => $users, 'search' => $query]);
    }

    /**
     * @param integer $id
     * @return View
     */
    public function show(int $id): View
    {
        return view('users.show', ['user' => User::findOrFail($id)]);
    }

    /**
     * @param integer $id
     * @return View
     */
    public function edit(int $id): View
    {
        $user  = User::findOrFail($id);
        $roles = Role::all(['id', 'name']);

        return view('users.edit', ['user' => $user, 'roles' => $roles]);
    }

    /**
     * @param UserEditFormRequest $request
     * @param integer $id
     * @return RedirectResponse
     */
    public function update(UserEditFormRequest $request, int $id): RedirectResponse
    {
        $this->users->update($request, $id);

        return redirect('/users');
    }

    /**
     * @param [type] $id
     * @return RedirectResponse
     */
    public function active(int $id): RedirectResponse
    {
        $this->users->active($id);

        return redirect('/users');
    }
}
