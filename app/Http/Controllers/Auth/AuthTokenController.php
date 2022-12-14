<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ActiveCode;
use App\Models\User;
use Illuminate\Http\Request;

class AuthTokenController extends Controller
{
    public function getToken(Request $request)
    {
        if(! $request->session()->has('auth'))
        {
            return redirect('/');
        }
        $request->session()->reflash('auth');
        return view('auth.token');
    }

    public function postToken(Request $request)
    {
        $data = $request->validate([
            'token' => 'required'
        ]);
        if(! $request->session()->has('auth'))
        {
            return redirect('/');
        }

        $user = User::findOrfail($request->session()->get('auth.user_id'));
        $status = ActiveCode::verifyCode($data['token'] , $user);

        if(! $status){
            alert()->error('خطا','رمز نادرست دوباره تلاش کنید.');
            return redirect(route('login'));
        }
        if(auth()->loginUsingId($user->id,$request->session()->get('auth.remember'))){
            $user->activeCodes()->delete();
            alert()->success('کاربر عزیز خوش آمدید','ورود موفقیت آمیز بود');
            redirect('/');
        }
        
        return redirect(route('login'));
        
    }
}
