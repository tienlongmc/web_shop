<?php

use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\Admin\MenuController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UploadController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('admin/user/login',[LoginController::class,'index'])->name('login');
Route::post('admin/user/login/store',[LoginController::class,'store']);


 // middleware để check session mới cho vào admin/main
 //nhóm các route khác vào để check session
Route::middleware(['auth'])->group(function () {

    Route::prefix('admin')->group(function(){
        Route::get('/',[MainController::class,'index'])->name('admin');
        Route::get('main',[MainController::class,'index']);

         

        //menu
        Route::prefix('menu')->group(function(){
            Route::get('add',[MenuController::class,'create']);
            Route::post('add',[MenuController::class,'store']);
            Route::get('list',[MenuController::class,'index']);
            Route::DELETE('destroy',[MenuController::class,'destroy']);
            Route::get('edit/{menu}',[MenuController::class,'show']);
            Route::post('edit/{menu}',[MenuController::class,'update']);
    });

    // Product
    Route::prefix('product')->group(Function(){
        Route::get('add',[ProductController::class,'create']);
        Route::post('add', [ProductController::class, 'store']);

    });

    #upload
    Route::post('upload/services', [UploadController::class, 'store'])->name('upload.services');


    });
});


