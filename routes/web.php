<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ActionLogController;






Route::get('/',function(){
    return view('auth.login');
});

Route::get('/register',function(){
    return view('auth.register');
})->name('register');

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function () {
 Route::prefix('/')->group(function(){
    Route::get('home',[ProfileController::class,'home'])->name('admin#home');
    Route::get('profilePage',[ProfileController::class,'profilePage'])->name('admin#profilePage');
    Route::post('profileChange',[ProfileController::class,'profileChange'])->name('admin#profileChange');
    Route::get('changePasswordPage',[ProfileController::class,'changePasswordPage'])->name('admin#changePasswordPage');
    Route::post('changePassword',[ProfileController::class,'changePassword'])->name('admin#changePassword');

    // admin list
    Route::get('list',[ListController::class,'list'])->name('admin#list');
    Route::get('accountDelete/{$id}',[ListController::class,'accountDelete'])->name('admin#accountDelete');

    // category
    Route::get('category',[CategoryController::class,'category'])->name('admin#category');
    Route::post('category/create',[CategoryController::class,'categoryCreate'])->name('admin#categoryCreate');
    Route::get('category/delete/{id}',[CategoryController::class,'categoryDelete'])->name('admin#categoryDelete');
    Route::post('category/search',[CategoryController::class,'categorySearch'])->name('admin#categorySearch');
    Route::get('category/editPage/{id}',[CategoryController::class,'editPage'])->name('admin#editPage');
    Route::post('category/update/{id}',[CategoryController::class,'updateCategory'])->name('admin#updateCategory');


    // Post
    Route::get('post/page',[PostController::class,'postPage'])->name('admin#postPage');
    Route::post('post/createPage',[PostController::class,'createPage'])->name('admin#createPage');
    Route::get('post/delete/{id}',[PostController::class,'postDelete'])->name('admin#postDelete');
    Route::get('post/editPost/{id}',[PostController::class,'editPost'])->name('admin#editPost');
    Route::post('post/updatePost/{id}',[PostController::class,'updatePost'])->name('admin#updatePost');

    // trend post 
    Route::get('trendpost',[ActionLogController::class,'TrendPost'])->name('admin#trendPost');
    Route::get('trendspost/details/{id}',[ActionLogController::class,'TrendsPostDetails'])->name('admin#postDetails');
});

});
