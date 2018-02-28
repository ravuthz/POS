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

use App\Models\Product;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
});

Route::get('/adminz/{vue_capture?}', function () {
    return view('admin.index');
})->where('vue_capture', '[\/\w\.-]*');

// Route::group(['middleware' => ['auth', 'crud.permissions'], 'prefix' => 'adminz'], function () {
//     Route::get('/', 'AdminController@index');
//     Route::resource('roles', 'RoleController');
//     Route::resource('products', 'ProductController');
//     Route::resource('categories', 'CategoryController');
//     Route::resource('settingtypes', 'SettingTypeController');
//     Route::resource('settingitems', 'SettingItemController');
//     Route::resource('stocks', 'StockController');
//     Route::resource('orders', 'OrderController');
// });

Auth::routes();

Route::group(['prefix' => 'api', 'namespace' => 'Api'], function() {

    Route::resource('products', 'ProductController', ['except' => ['create', 'edit']]);
    
});
