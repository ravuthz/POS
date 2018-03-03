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
    return redirect('/login');
});

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
});

Route::group([
    'prefix' => 'api', 
    'namespace' => 'Api',
    'middleware' => 'auth'
    ], function() {
        
    Route::apiResource('products', 'ProductController');
    Route::get('sales-products', 'ProductController@sales');
    Route::apiResource('sales', 'SaleProductController');
    
});

Route::group([
    'prefix' => 'adminz',
    'middleware' => ['auth', 'crud.permissions']
    ], function () {
        
    Route::get('/', 'AdminController@index');
    Route::resource('roles', 'RoleController');
    Route::resource('products', 'ProductController');
    Route::resource('categories', 'CategoryController');
    Route::resource('settingtypes', 'SettingTypeController');
    Route::resource('settingitems', 'SettingItemController');
    Route::resource('stocks', 'StockController');
    Route::resource('orders', 'OrderController');
    
});

Route::get('/seller/{vue_capture?}', function () {
    return view('vue');
})->where('vue_capture', '[\/\w\.-]*');

Auth::routes();


