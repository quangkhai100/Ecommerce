<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;

Route::group([
    'namespace' => 'Admin',
],function () {

Auth::routes();

Route::get ('/dashboard',[DashboardController::class, 'index']);

Route::get('/profile',[ProfileController::class, 'index']);
Route::post('/profile',[ProfileController::class, 'update']);

Route::get('/blog',[BlogController::class, 'index']);
Route::post('/blog',[BlogController::class, 'destroy']);
Route::get('/blog/add',[BlogController::class, 'create']);
Route::post('/blog/add',[BlogController::class, 'store']);
Route::get('/blog/update/{id}',[BlogController::class, 'edit']);
Route::post('/blog/update/{id}',[BlogController::class, 'update']);

Route::get('/country',[CountryController::class, 'index']);
Route::post('/country',[CountryController::class, 'destroy']);
Route::get('/country/add',[CountryController::class, 'create']);
Route::post('/country/add',[CountryController::class, 'store']);
Route::get('/country/update/{id}',[CountryController::class, 'edit']);
Route::post('/country/update/{id}',[CountryController::class, 'update']);

Route::get('/category',[CategoryController::class, 'index']);
Route::post('/category',[CategoryController::class, 'destroy']);
Route::get('/category/add',[CategoryController::class, 'create']);
Route::post('/category/add',[CategoryController::class, 'store']);
Route::get('/category/update/{id}',[CategoryController::class, 'edit']);
Route::post('/category/update/{id}',[CategoryController::class, 'update']);

Route::get('/brand',[BrandController::class, 'index']);
Route::post('/brand',[BrandController::class, 'destroy']);

Route::get('/brand/add',[BrandController::class, 'create']);
Route::post('/brand/add',[BrandController::class, 'store']);
Route::get('/brand/update/{id}',[BrandController::class, 'edit']);
Route::post('/brand/update/{id}',[BrandController::class, 'index']
);
});
?>