<?php

namespace App\Http\Controllers\Admin\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:user_show')->only('index');
        $this->middleware('can:user_create')->only(['create','store']);
        $this->middleware('can:user_edit')->only(['edit','update']);
        $this->middleware('can:user_delete')->only('delete');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::query();
        if($keyword = $request->search)
        {
            $users->where('email' , 'LIKE' , "%{$keyword}%")->orWhere('name', 'LIKE' , "%{$keyword}%");
        }
        if(Gate::allows('show_staff_user')){
            if($request->admin)
            {
                $users->where('is_superuser',1)->orWhere('is_staff',1);
            }
        }else{
            $users->where('is_superuser',0)->Where('is_staff',0)->get();   
        }
        $users = $users->paginate(10);
        return view('admin/user/index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        
        $user = User::create($data);

        if($request->has('verify')){
            $user->markEmailAsVerified();
        }
        $msg = 'کاربر با موفقیت ساخته شد.';
        return redirect(route('admin.users.index'))->with('success',$msg);
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
    public function edit(User $user)
    {
        return view('admin.user.update',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        ]);

        if(!is_null($request->password))
        {
            $request->validate([
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
            $data['password'] = $request->password;
        }
        $user->update($data);

        if($request->has('verify')){
            $user->markEmailAsVerified();
        }
        $msg = 'کاربر به ویرایش شد';
        return redirect(route('admin.users.index'))->with('success',$msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        $msg = 'با موفقیت حذف شد';
        return back()->with('success',$msg);
    }
}
