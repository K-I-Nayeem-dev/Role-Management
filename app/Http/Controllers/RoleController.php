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
        return view('roles.index');
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles|min:3',
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
    public function edit() {}


    // This Method Will Show Role Page
    public function show() {}

    // This Method Will delete Role
    public function destroy() {}
}
