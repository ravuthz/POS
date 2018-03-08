<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Traits\Authorizable;
use Illuminate\Http\Request;

class UserController1 extends Controller
{
    use Authorizable;

    public function index()
    {
        $result = User::latest()->paginate();
        return view('users.index', compact('result'));
    }

    public function create()
    {
        $roles = Role::pluck('name', 'id');
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:2',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'roles' => 'required|min:1'
        ]);

        $user = User::create($request->except('roles', 'permissions'));
        $this->syncPermissions($request, $user);

        return redirect()->route('users.index')
            ->with('success', 'User was created successfully :D');
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'id');
        $permissions = Permission::all('name', 'id');

        return view('users.edit', compact('user', 'roles', 'permissions'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|min:2',
            'email' => 'required|email|unique:users,email,' . $id,
            'roles' => 'required|min:1'
        ]);

        $user = User::findOrFail($id);
        $user->fill($request->except('roles', 'permissions', 'password'));

        if ($request->get('password')) {
            $user->password = $request->get('password');
        }

        $this->syncPermissions($request, $user);
        $user->save();
        return redirect()->route('users.index')
            ->with('success', 'User was updated successfully :D');
    }

    public function destroy($id)
    {
        if (Auth::user()->id == $id) {
            return redirect()->back()
                ->with('warning', 'Deletion of currently logged in user is not allowed :(');
        }

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()
            ->with('success', 'The user with id = ' . $id . ' delete successfully :D');
    }

    private function syncPermissions(Request $request, $user)
    {
        $roles = $request->get('roles', []);
        $permissions = $request->get('permissions', []);

        $roles = Role::find($roles);

        if (!$user->hasAllRoles($roles)) {
            $user->permissions()->sync([]);
        } else {
            $user->syncPermissions($permissions);
        }

        $user->syncRoles($roles);
        return $user;
    }
}
