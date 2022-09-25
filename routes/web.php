<?php

use App\Http\Controllers\Auth\AuthTokenController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
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