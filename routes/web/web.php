<?php

use App\Http\Controllers\Auth\AuthTokenController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Morilog\Jalali\Jalalian;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    // $client = new SoapClient("http://ippanel.com/class/sms/wsdlservice/server.php?wsdl");
	// $user = "smsuserid525"; 
	// $pass = "SamaneLine0371992249"; 
	// $fromNum = "+9810004223"; 
	// $toNum = array("09901245936"); 
	// $pattern_code = "r7t07b9vb0"; 
	// $input_data = array("code" => "13781378"); 

	// echo $client->sendPatternSms($fromNum,$toNum,$user,$pass,$pattern_code,$input_data);
    // return Jalalian::now();
    return view('welcome');


    // $url = "https://ippanel.com/services.jspd";
		
    // $rcpt_nm = array('09901245936');
    // $param = array
    //             (
    //                 'uname'=>'smsuserid525',
    //                 'pass'=>'SamaneLine0371992249',
    //                 'from'=>'+9810004223',
    //                 'message'=>'',
    //                 'to'=>json_encode($rcpt_nm),
    //                 'op'=>'send'
    //             );
                
    // $handler = curl_init($url);             
    // curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
    // curl_setopt($handler, CURLOPT_POSTFIELDS, $param);                       
    // curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
    // $response2 = curl_exec($handler);
    
    // $response2 = json_decode($response2);
    // $res_code = $response2[0];
    // $res_data = $response2[1];
    
    
    // echo $res_code;

});

Auth::routes(['verify'=>true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');

Route::get('secret',function(){
    return 'secret';
})->middleware(['auth','password.confirm']);

Route::middleware('auth')->group(function(){
Route::get('profile',[ProfileController::class,'index'])->name('profile');
Route::get('profile/twoFactor',[ProfileController::class,'manageTwoFactor'])->name('profile.two.Factor');
Route::post('profile/twoFactor',[ProfileController::class,'postManageTwoFactor'])->name('profile.manageTwoFactor');
Route::get('profile/twofacto/phone',[ProfileController::class,'getPhoneVerify'])->name('profile.2fa.phone');
Route::post('profile/twofacto/phone',[ProfileController::class,'postPhoneVerify']);
});

Route::get('/auth/token',[AuthTokenController::class,'getToken'])->name('2fa.token');
Route::post('/auth/token',[AuthTokenController::class,'postToken']);

Route::get('product',[ProductController::class,'index'])->name('home.product.index');
Route::get('product/{product}',[ProductController::class,'show'])->name('home.product.show');

Route::post('product/{product}/comment',[ProductController::class,'comment'])->name('home.product.comment')->middleware(['auth','verified']);