<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/auth/login',[\App\Http\Controllers\ApiAuthController::class,'login']);
Route::get('allcourses',[\App\Http\Controllers\CourseController::class,'index']);
Route::post('/auth/register_user', [\App\Http\Controllers\ApiAuthController::class,'register'] );
Route::middleware('auth:sanctum')->get('/auth/user',  [\App\Http\Controllers\ApiAuthController::class,'authUser']  );


Route::group([
    'middleware' => 'auth:sanctum',

], function ($router) {

    Route::resource('/courses', \App\Http\Controllers\CourseController::class);

});
