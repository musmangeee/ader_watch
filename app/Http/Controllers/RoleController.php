<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class RoleController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        $permission = Permission::get();
        return view('admin.roles.create', compact('permission'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'role_name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
        $role = Role::create(['name' => $request->role_name]);
        $role->syncPermissions($request->input('permission'));
        return redirect()->route('roles.index')->with('success', 'Role created successfully');
    }

    public function destroy($id)
    {
        DB::table("roles")->where('id', $id)->delete();
        return redirect()->route('roles.index')
            ->with('success', 'Role deleted successfully');
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
        return view('admin.roles.edit', compact('role', 'permission', 'rolePermissions'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'role_name' => 'required',
            'permission' => 'required',
        ]);


        $role = Role::find($id);
        $role->name = $request->input('role_name');
        $role->save();
        $role->syncPermissions($request->input('permission'));


        return redirect()->route('roles.index')
            ->with('success', 'Role updated successfully');
    }


}
