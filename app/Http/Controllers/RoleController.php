<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    // This Method Will Show Role Page
    public function index()
    {

        $roles = Role::orderBy('name', 'ASC')->paginate(10);

        return view('roles.index', [
            'roles' => $roles
        ]);
    }


    // This Method Will show roles create page
    public function create()
    {

        $permissions = Permission::orderBy('name', 'ASC')->get();

        return view('roles.create', [
            'permissions' => $permissions
        ]);
    }


    // This Method Will insert Role to DB
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                
                'name' => 'required|unique:roles|min:3',
                'permission' => 'required|array|min:1'],

            [
                'permission.required' => 'At least one permission is required.'
            ]);

        if ($validator->passes()) {
            $role = Role::create(['name' => $request->name]);

            if (!empty($request->permission)) {
                foreach ($request->permission as $name) {
                    $role->givePermissionTo($name);
                }
            }
        } else {
            return redirect()->route('roles.create')->withInput()->withErrors($validator);
        }

        return redirect()->route('roles.index')->with('success', 'Role Create Successfully');
    }


    // This Method Will Edit Role
    public function edit($id)
    {

        $role = Role::findOrFail($id);
        $hasPermissions = $role->permissions->pluck('name');
        $permissions = Permission::orderBy('name', 'ASC')->get();

        return view('roles.edit', [
            'role' => $role,
            'hasPermissions' => $hasPermissions,
            'permissions' => $permissions,
        ]);
    }


    // This Method Will Update Role
    public function update(Request $request ,$id)
    {

        $role = Role::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name,'.$id.',id|min:3',
        ]);

        if ($validator->passes()) {

            $role->name = $request->name;
            $role->save();

            if (!empty($request->permission)) {
                $role->syncPermissions($request->permission);
            } else{
                $role->syncPermissions([]);
            }

        } else {
            return redirect()->route('roles.edit', $id)->withInput()->withErrors($validator);
        }

        return redirect()->route('roles.index')->with('success', 'Role update Successfully');
    }

    // This Method Will delete Role
    public function destroy($id) {

        $role = Role::findOrFail($id);

        $role->delete();

        return redirect()->route('roles.index')->with('error', 'Role Deleted');

    }
}