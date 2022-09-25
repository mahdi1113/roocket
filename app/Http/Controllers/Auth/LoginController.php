<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ActiveCode;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function authenticated(Request $request,$user)
    {
        if($user->hasTwoFactorAuthenticatedEnabled())
        {
            auth()->logout();

            $request->session()->flash('auth',[
                'user_id' => $user->id,
                'using_sms' => false,
                'remember' => $request->has('remember'),
            ]);
            // این برای این هست که بعدا اگر احراز هویتی به جز پیامک داشتیم ریدایرکت کنیم به اون 
            if($user->two_factore_type == 'sms'){
                $code = ActiveCode::generateCode($user);
                // TODO SEND SMS
                $request->session()->push('auth.using_sms',true);
                return redirect(route('2fa.token'));
            }
        }
        return false;
    }
}
