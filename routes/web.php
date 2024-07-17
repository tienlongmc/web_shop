<?php

use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\MainHomeController;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\Admin\MenuController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\ProductHomeController;
use App\Http\Controllers\CartController;

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
        Route::get('list',[ProductController::class , 'index']);
        Route::get('edit/{product}',[ProductController::class,'show']);
        Route::post('edit/{product}',[ProductController::class,'update']);
        Route::DELETE('destroy',[ProductController::class,'destroy']);

    });
    //Slider
    Route::prefix('slider')->group(Function(){
        Route::get('add',[SliderController::class,'create']);
        Route::post('add', [SliderController::class, 'store']);
        Route::get('list',[SliderController::class , 'index']);
        Route::get('edit/{slider}',[SliderController::class,'show']);
        Route::post('edit/{slider}',[SliderController::class,'update']);
        Route::DELETE('destroy',[SliderController::class,'destroy']);

    });
    #upload
    Route::post('upload/services', [UploadController::class, 'store'])->name('upload.services');


    });
});

//main 

Route::get('/',[MainHomeController::class,'index']);
Route::post('/services/load-product', [App\Http\Controllers\MainHomeController::class, 'loadProduct']);
Route::get('danh-muc/{id}-{slug}.html',[App\Http\Controllers\MenuControler::class,'index']);
Route::get('san-pham/{id}-{slug}.html',[ProductHomeController::class,'index']);
Route::post('add-cart',[CartController::class,'index']);
Route::get('cart',[CartController::class,'show']);
Route::post('update-cart', [App\Http\Controllers\CartController::class, 'update']);
Route::get('carts/delete/{id}', [App\Http\Controllers\CartController::class, 'remove']);
Route::post('cart',[CartController::class,'addCart']);

