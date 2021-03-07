<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $permissions = Permission::all();

        return view('backend.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'permission' => 'required|unique:permissions,name',
        ]);
        $product = new Permission();
        $product->name = $request->permission;
        $product->save();
        $role = Role::findByName('super-admin');
        $role->givePermissionTo($request->permission);
        return redirect()->route('admin.permissions.index')->with('success', 'Permission is successfully saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return view('backend.permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'permission' => 'required|unique:permissions,name,' . $id,
        ]);
        $product =  Permission::findOrFail($id);
        $product->name = $request->permission;
        $product->save();
        // $role = Role::findByName('super-admin');
        // $role->syncPermissions($request->permission);
        return redirect()->route('admin.permissions.index')->with('success', 'Permission is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = Permission::findOrFail($id);
        $destroy->delete();
        return redirect()->route('admin.permissions.index')->with('success', 'Permission is successfully deleted');

    }
}
