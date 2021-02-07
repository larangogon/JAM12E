<?php

namespace App\Http\Controllers\AdminV1;

use App\Http\Requests\UserFormRequest;
use App\Entities\Role;
use App\Entities\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Interfaces\InterfaceUsers;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\UserEditFormRequest;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    protected $users;

    /**
     * UserController constructor.
     * @param InterfaceUsers $users
     * @param User $user
     */
    public function __construct(InterfaceUsers $users, User $user)
    {
        $this->users = $users;
        $this->user = $user;
        $this->middleware('auth');
        $this->middleware('Status');
        $this->middleware('verified');
    }

    /**
     * @param Request $request
     * @return View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request): View
    {
        $this->authorize('user.index');

        $role = $request->get('role', null);

        $search   = $request->get('search', null);

        $this->user = new User();

        return view('users.index', [
            'search' => $search,
            'users'  => $this->user
                ->role($role)
                ->search($search)
                ->paginate(15)
        ]);
    }

    /**
     * @return View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(): View
    {
        $this->authorize('user.create');

        $roles = Role::all(['name', 'id']);

        return view('users.create', ['roles' => $roles]);
    }

    /**
     * @param UserFormRequest $request
     * @return RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(UserFormRequest $request): RedirectResponse
    {
        $this->authorize('user.store');

        $this->users->store($request);

        return redirect('/users');
    }

    /**
     * @param User $user
     * @return View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(User $user): View
    {
        $this->authorize('user.show');

        return view('users.show', compact('user'));
    }

    /**
     * @param User $user
     * @return View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(User $user): View
    {
        $this->authorize('user.edit');

        $roles = Role::all(['id', 'name']);

        return view('users.edit', [
            'user'  => $user,
            'roles' => $roles
        ]);
    }

    /**
     * @param UserEditFormRequest $request
     * @param User $user
     * @return RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UserEditFormRequest $request, User $user): RedirectResponse
    {
        $this->authorize('user.update');

        $this->users->update($request, $user);

        return redirect('/users');
    }

    /**
     * @param User $user
     * @return RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function active(user $user): RedirectResponse
    {
        $this->authorize('user.status');

        $this->users->active($user);

        return redirect('/users');
    }
}
