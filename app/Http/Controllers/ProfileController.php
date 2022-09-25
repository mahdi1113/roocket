<?php

namespace App\Http\Controllers;

use App\Models\ActiveCode;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index');
    }

    public function manageTwoFactor()
    {
        return view('profile.two-factor-auth');
    }

    public function postManageTwoFactor(Request $request)
    {

        $data = $request->validate([
            'type' => 'required|in:sms,off',
            'phone' => 'required_unless:type,off|unique:users,phone_number'
        ]);
       
        if($data['type'] === 'sms'){
            
            if(auth()->user()->phone_number !== $data['phone']){
                $code = ActiveCode::generateCode(auth()->user());      
                $request->session()->flash('phone', $data['phone']);
                // TODO SEND SMS
                return redirect(route('profile.2fa.phone'));
            }else{
                auth()->user()->update([
                    'two_factore_type' => 'sms'
                ]);
            }
        }

        if($data['type'] === 'off'){
            auth()->user()->update([
                'two_factore_type' => 'off',
            ]);
        }

        return back();
    }

    public function getPhoneVerify(Request $request)
    {
        if(! $request->session()->has('phone'))
        {
            return redirect(route('profile.two.Factor'));
        }

        $request->session()->reflash();

        return view('profile.phone-verify');
    }

    public function postPhoneVerify(Request $request)
    {
        $request->validate([
            'token' => 'required'
        ]);

        if(! $request->session()->has('phone'))
        {
            return redirect(route('profile.two.Factor'));
        }

        $status = ActiveCode::verifyCode($request->token , auth()->user());

        if($status){
            $user = auth()->user();
            $request->user()->activeCodes()->delete();
            $user->update([
                'phone_number' => $request->session()->get('phone'),
                'tow_factore_type' => 'sms'
            ]);
            alert()->success('شماره تلفن و احراز هویت دو مرحله ای شما تایید شد ', 'عملیات موفقیت آمیز بود');
        }else{
            alert()->error('رمز عبور وارد شده اشتباه بود لطفا دوباره تلاش کنید', 'خطا');
            return redirect(route('profile.two.Factor'));
        }
        return redirect(route('profile.two.Factor'));
    }

}
