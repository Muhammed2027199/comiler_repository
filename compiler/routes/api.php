<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\MallController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VendorProductController ;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:sanctum'], function(){
    Route::group(['prefix'=>'managers'], function(){
        Route::apiResource('manager', ManagerController::class);
    });
    Route::group(['prefix'=>'malls'], function(){
        Route::apiResource('mall', MallController::class);
    });
    Route::group(['prefix'=>'departments'], function(){
        Route::apiResource('department', DepartmentController::class);
    });
    Route::group(['prefix'=>'vendors'], function(){
        Route::apiResource('vendor', VendorController::class);
    });
    Route::group(['prefix'=>'products'], function(){
        Route::apiResource('product', ProductController::class);
    });
    Route::group(['prefix'=>'vendorproducts'], function(){
        Route::apiResource('vendorproduct', VendorProductController ::class)->only(['store','index','destroy']);
    });
});

Route::post("login",[UserController::class,'login']);
Route::post("register",[UserController::class,'register']);






