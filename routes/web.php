<?php

use App\Http\Controllers\CheckoutController;
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

Route::prefix('admin')->namespace('Admin')->middleware(['auth','admin'])->group(function() {
    Route::get('/', 'DashboardController@index')
        ->name('admin-dashboard');
    Route::resource('category', 'CategoryController');
    Route::resource('user', 'UserController');
    Route::resource('product', 'ProductController');
    Route::resource('gallery', 'GalleryController');
});
/*----------------------------|End Admin Route|--------------------------------*/


/*--------------------------------|App Route|----------------------------------*/

Route::get('/', 'HomeController@index')
    ->middleware(['auth'])
    ->name('home');

Route::get('category', 'CategoryController@index')
    ->middleware(['auth'])
    ->name('category');
Route::get('category/{id}', 'CategoryController@detail')
    ->middleware(['auth'])    
    ->name('category-detail');

Route::get('product/{id}', 'ProductController@detail')
    ->middleware(['auth'])    
    ->name('product-detail');

Route::get('cart', 'CartController@index')
    ->middleware(['auth'])    
    ->name('cart');
Route::post('cart/add/{id}', 'CartController@addToCart')
    ->middleware(['auth'])    
    ->name('cart-add');
Route::delete('cart/delete/{id}', 'CartController@delete')
    ->middleware(['auth'])
    ->name('cart-delete');

Route::post('checkout', 'CheckoutController@process')
    ->middleware(['auth'])
    ->name('checkout');
Route::post('checkout/callback', 'CheckoutController@callback')
    ->middleware(['auth'])
    ->name('callback');

/*------------------------------|End App Route|--------------------------------*/

/*-----------------------------|Dashboard Route|-------------------------------*/

Route::prefix('dashboard')->namespace('dashboard')->middleware(['auth'])->group(function() {
    Route::get('/', 'DashboardController@index')
        ->name('dashboard');
    
    Route::get('product', 'ProductController@index')
        ->name('dashboard-product');
    Route::get('product/create', 'ProductController@create')
        ->name('dashboard-product-create');
    Route::post('product/store', 'ProductController@store')
        ->name('dashboard-product-store');
    Route::get('product/detail/{id}', 'ProductController@details')
        ->name('dashboard-product-detail');
    Route::get('product/update/{id}', 'ProductController@update')
        ->name('dashboard-product-update');
    
    Route::post('gallery/upload', 'ProductController@uploadProductGallery')
        ->name('dashboard-gallery-upload');
    Route::get('gallery/delete/{id}', 'ProductController@deleteProductGallery')
        ->name('dashboard-gallery-delete');

    Route::get('setting', 'SettingController@store')
        ->name('dashboard-setting-store');
    Route::get('account', 'SettingController@account')
        ->name('dashboard-setting-account');
    Route::post('update/{redirect}', 'SettingController@update')
        ->name('dashboard-setting-redirect');

    Route::get('transaction', 'TransactionController@index')
        ->name('dashboard-transaction');
    Route::get('transaction/detail/{id}', 'TransactionController@detail')
        ->name('dashboard-transaction-detail');
    Route::get('transaction/update/{id}', 'TransactionController@update')
        ->name('dashboard-transaction-update');
});

/*---------------------------|End Dashboard Route|-----------------------------*/