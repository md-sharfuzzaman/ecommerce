<?php

use App\Http\Controllers\Admin\AdminController;
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
Route::get('/', function(){
    return "এইডা হইলো ইউজার ফ্রন্ট পেইজ। অইডাতে পরবর্তীতে কাজ করা হবে। আপাতত ব্যাক-এন্ড নিয়া  আছি।";
});


Route::prefix('admin')->namespace('Admin')->group(function () {

    // All the admin routes will be defined here:-
    Route::match(['get', 'post'],'/', [AdminController::class, 'login']);
    Route::group(['middleware'=>['admin']], function(){
        Route::get('dashboard', [AdminController::class, 'dashboard']);
        Route::get('settings', [AdminController::class, 'settings']);
        Route::post('check-current-pwd', [AdminController::class, 'chkCurrentPassword']);
        Route::post('update-current-pwd', [AdminController::class, 'updateCurrentPassword']);
        Route::get('logout', [AdminController::class, 'logout']);
    });
   
});

