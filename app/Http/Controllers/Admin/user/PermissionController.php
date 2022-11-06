<?php

namespace App\Http\Controllers\Admin\user;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function create(User $user)
    {
        $permissions = Permission::all();
        $roles = Role::all();
        return view('admin.user.permission',compact('permissions','roles','user'));
    }

    public function store(Request $request , User $user)
    {
        $data = $request->validate([
            'permissions' => ['required','array'],
            'roles' => ['required','array']
        ]);

        $user->permissions()->sync($data['permissions']);
        $user->roles()->sync($data['roles']);
        $msg = 'دسترسی ها اعمال شدند';
        return redirect(route('admin.users.index'))->with('success',$msg);
    }
}
