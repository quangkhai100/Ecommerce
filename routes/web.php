<?php

use App\Http\Controllers\Frontend\BlogListController;
use App\Http\Controllers\Frontend\RateBlogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UpdateBlogController;
use App\Http\Controllers\UpdateCountryController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', 'HomeController@index')->name('home');

//Front Ends
Route::group([
    'namespace' => 'Frontend',
],function () {
    
    Route::get('/blog/list','BlogController@index');

    Route::get('/blog/detail/{id}','BlogController@show');

    Route::get('member/register','MemberController@indexRegister')->middleware('CheckLogin');

    Route::post('member/register','MemberController@create')->middleware('CheckLogin');

    Route::get('member/login','MemberController@indexLogin')->name('memberLogin');

    Route::post('member/login','MemberController@login')->middleware('CheckLogin');
    
    Route::get('member/home','HomeController@index')->name('memberHome');

    
    Route::post('/search','HomeController@search');
    
    Route::post('/search/advanced','HomeController@searchAdvanced');

    Route::get('member/products','ProductController@index')->middleware('MemberRole');

    Route::get('member/products/details/{id}','ProductController@productDetailsView')->middleware('MemberRole');

    Route::get('member/products/{id}','ProductController@destroy')->middleware('MemberRole');
    
    Route::get('member/add/product','ProductController@create')->middleware('MemberRole');

    Route::post('member/add/product','ProductController@store')->middleware('MemberRole');

    Route::get('member/product/update/{id}','ProductController@edit')->middleware('MemberRole');
    
    Route::post('member/product/update/{id}','ProductController@update')->middleware('MemberRole');

    Route::post('/rate/ajax/','RateBlogController@index')->name('ajax_rate_blog')->middleware('MemberRole');

    Route::post('/comment/ajax','CommentBlogController@index')->middleware('MemberRole');

    Route::get('logout', 'MemberController@logout')->middleware('MemberRole');

    Route::get('member/{id}','MemberController@edit')->middleware('MemberRole');

    Route::post('member/{id}','MemberController@update')->middleware('MemberRole');
    
    Route::post('/addToCart/ajax','ProductController@ajaxAddtoCart')->middleware('MemberRole');

    Route::get('/cart','CartController@index');
    
    Route::post('/caculate/ajax','CartController@caculate');

    Route::post('/delete/ajax','CartController@delete');

    Route::post('/cart','CartController@checkout');
});



