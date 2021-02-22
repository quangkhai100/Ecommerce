<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CountryController ;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\RegisterController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//api register
Route::post('register', [RegisterController::class, 'register']);
//login--create token
Route::post('login',[LoginController::class,'login']);
//list country
Route::get('country',[CountryController::class,'index']);
//refresh token
Route::post('refresh-token',[LoginController::class,'refreshToken']);
//delete token
Route::delete('delete-token',[LoginController::class,'deleteToken']);
