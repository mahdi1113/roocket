<?php

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
    alert()->success('how are you ? ','Message');
    return view('welcome');
});



Auth::routes(['verify'=>true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');

Route::get('secret',function(){
    return 'secret';
})->middleware(['auth','password.confirm']);

Route::get('profile',[ProfileController::class,'index'])->name('profile');
Route::get('profile/twoFactor',[ProfileController::class,'manageTwoFactor'])->name('profile.two.Factor');
Route::post('profile/twoFactor',[ProfileController::class,'postManageTwoFactor'])->name('profile.manageTwoFactor');