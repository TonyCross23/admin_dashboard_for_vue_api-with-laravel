<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\api\PostController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\ActionLogController;





// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('user/login',[AuthController::class,'login']);
Route::post('user/register',[AuthController::class,'register']);

Route::get('category',[AuthController::class,'categoryList'])->middleware('auth:sanctum');

// get all post list
Route::get('allPostlist',[PostController::class,'allPostList']);
// search Post
Route::post('allPostSearch',[PostController::class,'allPostSearch']);
// post details
Route::post('post/details',[PostController::class,'postDetails']);

// get all category list
Route::get('getAllCategory',[CategoryController::class,'getAllPost']);

// category search 
Route::post('category/search',[CategoryController::class,'categorySearch']);

// acotin log
Route::post('post/actionlog',[ActionLogController::class,'postActionLog']);