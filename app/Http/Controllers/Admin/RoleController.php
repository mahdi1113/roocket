<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = Role::query();
        if($keyword = $request->search)
        {
            $roles->where('name',$request->search);
        }
        $roles = $roles->paginate(3);
        return view('admin.role.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.role.create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:permissions',
            'label' => 'required|string|max:255'
        ]);

        $role = Role::create($data);
        $role->permissions()->sync($request->permissions);
        $msg = 'نقش با موفقیت ساخته شد .';
        return redirect(route('admin.roles.index'))->with('success',$msg);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.role.update',compact('role','permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255',Rule::unique('roles')->ignore($role->id)],
            'label' => ['required','string','max:255'],
            'permissions' => ['required','array']
        ]);
        $role->update($request->all());
        $role->permissions()->sync($request->permissions);
        $msg = 'آیتم با موفقیت آپدیت شد';
        return redirect(route('admin.roles.index'))->with('success',$msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        $msg = 'آیتم با موفقیت حذف شد';
        return back()->with('success',$msg);
    }
}
