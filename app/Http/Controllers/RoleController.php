<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Interfaces\InterfaceRoles;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    protected $roles;

    /**
     * RoleController constructor.
     * @param InterfaceRoles $roles
     */
    public function __construct(InterfaceRoles $roles)
    {
        $this->roles = $roles;
        $this->middleware('auth');
        $this->middleware('Status');
        $this->middleware('verified');
        $this->middleware('role:Administrator');
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $roles = Role::all(['id','name']);
        $permissions = Permission::all(['id','name']);

        return view('roles.index', [
            'roles'       => $roles,
            'permissions' => $permissions
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        Role::create($request->all());

        return redirect('roles');
    }

    /**
     * @param Request $request
     * @param Role $role
     * @return RedirectResponse
     */
    public function update(Request $request, Role $role): RedirectResponse
    {
        $role->syncPermissions($request->permissions);

        return redirect('roles');
    }

    /**
     * @param Role $role
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Role $role): RedirectResponse
    {
        $role->delete();

        return redirect('roles');
    }
}
