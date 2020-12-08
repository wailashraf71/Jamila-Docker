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
Route::namespace('Api')->as('api.')->group(function () {
    Route::post('login', 'LoginController@login')->name('login');
    Route::get('refresh', 'LoginController@refresh')->name('refresh');
    Route::post('logout', 'LoginController@logout')->name('logout');
    Route::post('register', 'RegisterController@register')->name('register');
    Route::resource('products', 'ProductController');
    Route::resource('categories', 'CategoryController');
    Route::resource('adverts', 'AdvertController');
    Route::get('categories/{id}/products', 'CategoryController@products');
    Route::get('adverts/{id}/products', 'AdvertController@products');
    Route::get('/search', ['uses' => 'SearchController@getSearch', 'as' => 'search']);
    Route::get('/suggestions', ['uses' => 'SearchController@getSuggestions', 'as' => 'suggestions']);
    Route::get('home', 'HomeController@index');

    Route::group(['middleware' => ['auth:api']], function () {
        Route::get('me', 'LoginController@me')->name('me');
        Route::post('me', 'LoginController@meUpdate');
        Route::resource('orders', 'OrderController');
        Route::resource('users', 'UserController');
    });
});
