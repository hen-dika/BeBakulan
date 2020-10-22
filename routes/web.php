<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::get('/debug-sentry', function () {
    throw new Exception('My first Sentry error!');
});

Auth::routes();

/*------------------------------|Admin Route|---------------------------------*/

// ->middleware(['auth','admin'])
Route::prefix('admin')->namespace('Admin')->group(function() {
    Route::get('/', 'DashboardController@index')->name('admin-dashboard');
    Route::resource('category', 'CategoryController');
    Route::resource('user', 'UserController');
    Route::resource('product', 'ProductController');
    Route::resource('gallery', 'GalleryController');
});
/*----------------------------|End Admin Route|--------------------------------*/


/*--------------------------------|App Route|----------------------------------*/

Route::get('/', 'HomeController@index')->name('home');

Route::get('category', 'CategoryController@index')->name('category');
Route::get('category/{id}', 'CategoryController@detail')->name('category-detail');

Route::get('product/{id}', 'ProductController@detail')->name('product-detail');

Route::get('cart', 'CartController@index')->name('cart');
Route::post('cart/add/{id}', 'CartController@addToCart')->name('cart-add');
Route::delete('cart/delete/{id}', 'CartController@delete')->name('cart-delete');

/*------------------------------|End App Route|--------------------------------*/

Route::get('register/check', 'Auth\RegisterController@check')->name('api-register-check');