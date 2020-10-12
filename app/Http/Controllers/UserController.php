<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Http\Requests\UserFormRequest;
use App\Http\Requests\UserStoreRequest;
use App\Role;
use App\User;
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
    public function __construct(InterfaceUsers $users, User $user)
    {
        $this->users = $users;
        $this->user = $user;
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
        $role = $request->get('role', null);
        $search   = $request->get('search', null);

        $this->user = new User();

        return view('users.index', [
            'search'   => $search,
            'users' => $this->user
                ->role($role)
                ->search($search)
                ->paginate(12)
        ]);
    }

    /**
     * @return View
     */
    public function create(): View
    {
        $roles = Role::all();

        return view('users.create', ['roles' => $roles]);
    }

    /**
     * @param UserFormRequest $request
     * @return RedirectResponse
     */
    public function store(UserFormRequest $request): RedirectResponse
    {
        $user = User::create($request->all());

        $user->asignarRol($request->get('rol'));

        $this->cart = new Cart();

        $this->cart->user_id = $user->id;
        $this->cart->save();

        return redirect('/users');
    }

    /**
     * @param int $id
     * @return View
     */
    public function show(int $id): View
    {
        return view('users.show', [
            'user' => User::findOrFail($id)
        ]);
    }

    /**
     * @param integer $id
     * @return View
     */
    public function edit(int $id): View
    {
        $user  = User::findOrFail($id);
        $roles = Role::all(['id', 'name']);

        return view('users.edit', [
            'user'  => $user,
            'roles' => $roles
        ]);
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
     * @param int $id
     * @return RedirectResponse
     */
    public function active(int $id): RedirectResponse
    {
        $this->users->active($id);

        return redirect('/users');
    }
}
