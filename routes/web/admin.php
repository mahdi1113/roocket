<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\admin\CommentController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\user\PermissionController as UserPermissionController;
use App\Http\Controllers\Admin\user\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/',function(){
    // Auth::loginUsingId(2);
    return view('admin.index');
})->name('index');

Route::resource('users',UserController::class);
Route::get('user/permission/{user}',[UserPermissionController::class,'create'])->name('user.permission.create')->middleware('can:staff_user_permissions');
Route::post('user/permission/{user}',[UserPermissionController::class,'store'])->name('user.permission.store')->middleware('can:staff_user_permissions');
Route::resource('permissions',PermissionController::class);
Route::resource('roles',RoleController::class);
Route::resource('product',ProductController::class);

Route::get('comments/unApproved',[CommentController::class,'unApproved'])->name('comment.unApproved');
Route::get('comments/updateUnApproved/{comment}',[CommentController::class,'updateUnApproved'])->name('comments.updateUnApproved');
Route::resource('comments',CommentController::class)->only(['index','destroy','update']);

Route::resource('categories',CategoryController::class);