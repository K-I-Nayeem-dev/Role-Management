<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class PermissionController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view permissions', only: ['index']),
            new Middleware('permission:edit permissions', only: ['edit']),
            new Middleware('permission:create permissions', only: ['create']),
            new Middleware('permission:delete permissions', only: ['destroy']),
        ];
    }

    // This Method Will Show Permission Page
    public function index()
    {
        $permissions = Permission::orderBy('created_at', 'DESC')->paginate(10);
        return view('Permissions.index', [
            'permissions' => $permissions
        ]);
    }

    // This Method Will Show create Permission Page
    public function create()
    {
        return view('Permissions.create');
    }

    // This Method Will insert a Permission in DB
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:permissions|min:3',
        ]);

        if ($validator->passes()) {
            Permission::create([
                'name' => $request->name
            ]);
        } else {
            return redirect()->route('permission.create')->withInput()->withErrors($validator);
        }

        return redirect()->route('permission.index')->with('success', 'Permission Create Successfully');
    }


    // This Method Will show edit  Permission page,
    public function edit($id)
    {

        $permission = Permission::findOrFail($id);

        return view('Permissions.edit', [
            'permission' => $permission
        ]);
    }

    // This Method Will update a Permission,
    public function update(Request $request, $id)
    {

        $permission = Permission::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|unique:permissions,name,' . $id . ',id'
        ]);

        if ($validator->passes()) {

            $permission->name = $request->name;
            $permission->save();

            return redirect()->route('permission.index')->with('success', 'Edit Permission Successfully');
        } else {
            return redirect()->route('permission.edit', $permission->id)->withInput()->withErrors($validator);
        }
    }


    // This Method Will delete a Permission,
    public function destroy($id)
    {

        $permission = Permission::find($id);

        $permission->delete();

        return redirect()->route('permission.index')->with('success', 'Permission deleted');
    }
}
