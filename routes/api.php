<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Policies\CategoryPolicy;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::group(['prfix'=> 'v1'])
//Auth Users
Route::prefix('auth')->group(function(){
    Route::post('/login',[AuthController::class,'login']);
    Route::post('/register',[AuthController::class,'register']);
});

//Category 
Route::middleware('auth:sanctum')->prefix('v1')->group(function(){
    Route::get('/users/list',[PostController::class,'index']);
    Route::post('/category/create',[CategoryController::class,'create']);
    Route::get('/category/list',[CategoryController::class,'index']);
    Route::delete('category/destroy/{id}',[CategoryController::class,'destroy']);
    //Route::post('/categories',[CategoryController::class,'store']);
});
// Route::middleware('auth:sanctum')->get('v1/users',function(){
    
// });
