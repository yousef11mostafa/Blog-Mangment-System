<?php

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



//--------------- authintication routes -------------
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);
Route::post('refresh', [AuthController::class, 'refresh']);
Route::get('profile', [AuthController::class, 'profile'])->middleware('auth:api');
Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('reset-password', [AuthController::class, 'resetPassword'])->name("password.reset");


Route::get("test",[TestController::class,'index']);


//-------------- posts routes ------------------
Route::prefix('posts')->middleware('auth:api')->name('posts.')->group(function(){

        Route::get("/{post}",[PostsController::class,'index']);
        Route::post("/create",[PostsController::class,'create']);
        Route::post("/edit/{post}",[PostsController::class,'update']);
        Route::post("/delete/{post}",[PostsController::class,'delete']);

});



//-------------  comments routes--------------
Route::prefix('comments')->name('comments.')->group(function(){

        Route::get("/{comment}",[CommentsController::class,'index']);
        Route::post("/create",[CommentsController::class,'create']);
        Route::post("/edit/{comment}",[CommentsController::class,'update']);
        Route::post("/delete/{comment}",[CommentsController::class,'delete']);

})->middleware('auth:api');



//-------------User routes ------------------------

Route::prefix('user')->middleware('auth:api')->name("user.")->group(function(){
      Route::get('/',[UserController::class,'index']);
      Route::get('/getroles',[UserController::class,'getroles']);
      Route::post('/updateProfile',[UserController::class,'updateProfile']);
      Route::post('/changePassword',[UserController::class,'changePassword']);
});
//-------------Admin routes ------------------------

Route::prefix('admin')->middleware('auth:api')->name("admin.")->group(function(){
      Route::get('/',[AdminController::class,'indexUsers']);
      Route::get('/indexPosts',[AdminController::class,'indexPosts']);
      Route::get('/indexComments',[AdminController::class,'indexComments']);
      Route::post('/approvePost/{postId}',[AdminController::class,'approvePost']);
      Route::post('/assignRole/{userId}',[AdminController::class,'assignRole']);
      Route::get('/indexRoles/{userId}',[AdminController::class,'indexRoles']);
      Route::get('/indexPermissions/{userId}',[AdminController::class,'indexPermissions']);
      Route::post('/updatePermissions/{roleId}',[AdminController::class,'updatePermissions']);
});



// --------- Front routes -----------------

Route::get("/",[FrontController::class,'index']);














// rmdir /s /q .git
//git init
