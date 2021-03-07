<?php

namespace App\Http\Controllers\Backend;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::all();
        return view('backend.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (count(Role::all()) <= 1) {
            return redirect()->route('admin.users.index')->with('errors', 'Please first create a role');
        }
        $roles = Role::get()->pluck('name', 'name')->toArray();
        $not = ['super-admin' => 'super-admin'];
        $roles = array_diff($roles, $not);
        return view('backend.users.create', compact('roles'));
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'roles' => 'required'
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        if ($request->roles) {
            $roles = $request->input('roles') ? $request->input('roles') : [];
            $user->assignRole($roles);
        }

        return redirect()->route('admin.users.index')->with('success', 'User is successfully saved');
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
        $user = User::findOrFail($id);
        $roles = Role::get()->pluck('name', 'name')->toArray();
        if (count($user->getRoleNames()) == 1) {
            if ($user->hasRole("super-admin")) {
                $not = ['super-admin' => 'super-admin'];
                $roles = array_intersect($roles, $not);
                return view('backend.users.edit', compact('user', 'roles'));
            } else {
                $not = ['super-admin' => 'super-admin'];
                $roles = array_diff($roles, $not);
                return view('backend.users.edit', compact('user', 'roles'));
            }
        } else {
            $not = ['super-admin' => 'super-admin'];
            $roles = array_diff($roles, $not);
            return view('backend.users.edit', compact('user', 'roles'));
        }
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'roles' => 'required'
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        if ($request->roles) {
            $roles = $request->input('roles') ? $request->input('roles') : [];
            $user->syncRoles($roles);
        }

        return redirect()->route('admin.users.index')->with('success', 'User is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = User::findOrFail($id);
        if (count($destroy->getRoleNames()) == 1) {
            if ($destroy->hasRole("super-admin")) {
                return redirect()->route('admin.users.index')->with('errors', 'Super admin can\'t be delete');
            } else {
                $destroy->delete();
                return redirect()->route('admin.users.index')->with('success', 'User is successfully deleted');
            }
        } else {
            $destroy->delete();
            return redirect()->route('admin.users.index')->with('success', 'User is successfully deleted');
        }
    }
}
