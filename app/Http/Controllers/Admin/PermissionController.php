<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $permissions = Permission::query();
        if($keyword = $request->search)
        {
            $permissions->where('name','LIKE',"%{$keyword}%");
        }
        $permissions = $permissions->paginate(3);
        return view('admin.permission.index',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.permission.create');
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

        Permission::create($data);
        $msg = 'دسترسی با موفقیت ساخته شد .';
        return redirect(route('admin.permissions.index'))->with('success',$msg);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        return view('admin.permission.update',compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
            $data = $request->validate([
                'name' => ['required','string','max:255',Rule::unique('permissions')->ignore($permission->id)],
                'label' => ['required','string','max:255'],
            ]);
            $permission->update($request->all());
            $msg = 'آیتم با موفقیت آپدیت شد';
            return redirect(route('admin.permissions.index'))->with('success',$msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        $msg = 'آیتم با موفقیت حذف شد';
        return back()->with('success',$msg);
    }
}
