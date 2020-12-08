<?php

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

Route::prefix('admin')->as('admin.')->group(function () {
    Route::group(['middleware' => ['auth:web']], function () {
        Route::get('/', 'DashboardController@index')->name('admin');
        Route::resource('products', 'ProductController');
        Route::resource('categories', 'CategoryController');
        Route::resource('adverts', 'AdvertController');
        Route::post('adverts/{advert}/add', 'AdvertController@addProduct')->name('adverts.add');
        Route::post('adverts/{advert}/remove', 'AdvertController@removeProduct')->name('adverts.remove');
        Route::resource('orders', 'OrderController');
        Route::get('ordersData', 'OrderController@data')->name('orders.data');
        Route::resource('users', 'UserController');
        Route::get('usersData', 'UserController@data')->name('users.data');;

    });
});
Route::get('/', function () {
    return redirect('/login');
});

Route::fallback(function () {
    return view('admin.404');
});
