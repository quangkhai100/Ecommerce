<?php 
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Auth\LoginController;

Auth::routes();

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth']
],function () { 

Route::get('/register', [LoginController::class, 'showRegistrationForm'])->name('register');

Route::post('/register', [LoginController::class, 'register']);


Route::get ('/dashboard',[DashboardController::class, 'index'])->name('dashboard.index');

Route::get('/profile',[ProfileController::class, 'index'])->name('profile.index');

Route::post('/profile',[ProfileController::class, 'update'])->name('profile.update');

Route::resource('/blog', BlogController::class);

Route::resource('/country', CountryController::class);

Route::resource('/category', CategoryController::class);

Route::resource('/brand', BrandController::class);

});

?>