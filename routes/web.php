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
use App\Models\SettingType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
], function () {
    Route::get('auth', function () {
        return Auth::user();
    });

    Route::get('count/orders', 'CountController@orders');

    Route::apiResource('products', 'ProductController');
    Route::get('sales-products', 'ProductController@sales');
    Route::apiResource('sales', 'SaleProductController');

    Route::get('order-types', function () {
        $type = SettingType::whereSlug('order-type')->first();
        return ['data' => $type->settingItems->pluck('name', 'id')];
    });

    Route::get('stock-movements', function () {
        $type = SettingType::whereSlug('movement')->first();
        return ['data' => $type->settingItems->pluck('name')];
    });

    Route::get('list-products', function () {
        return ['data' => Product::pluck('name', 'id')];
    });
    Route::apiResource('orders', 'OrderController');
    Route::resource('stocks', 'StockController');
});

Route::group([
    'prefix' => 'adminz',
    'middleware' => ['auth', 'role:admin']
], function () {
    Route::get('/', 'AdminController@index');
    Route::resource('users', 'Admin\UserController');
    Route::resource('roles', 'Admin\RoleController');
    Route::resource('permissions', 'Admin\PermissionController');
    Route::resource('settingtypes', 'SettingTypeController');
    Route::resource('settingitems', 'SettingItemController');
});

Route::group([
    'prefix' => 'adminz',
    'middleware' => ['auth', 'crud.permissions']
], function () {
    Route::resource('products', 'ProductController');
    Route::resource('categories', 'CategoryController');
    Route::resource('stocks', 'StockController');
    Route::resource('orders', 'OrderController');

});

Route::group([
    'prefix' => 'seller',
    'middleware' => ['auth']
], function () {
    Route::get('/{vue_capture?}', function () {
        return view('vue');
    })->where('vue_capture', '[\/\w\.-]*');
});

Auth::routes();
