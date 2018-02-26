<?php

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

Auth::routes();

Route::get('adminz/products/json', 'AdminController@products');

Route::group(['middleware' => ['auth', 'crud.permissions'], 'prefix' => 'adminz'], function () {
    Route::get('/', 'AdminController@index');
    Route::resource('roles', 'RoleController');
    Route::resource('products', 'ProductController');
    Route::resource('categories', 'CategoryController');
    Route::resource('settingtypes', 'SettingTypeController');
    Route::resource('settingitems', 'SettingItemController');
    Route::resource('stocks', 'StockController');
    Route::resource('orders', 'OrderController');

});
