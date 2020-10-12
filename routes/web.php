<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified', 'Status');
Route::resource('users', 'UserController');
Route::get('users/{user}/active')->uses('UserController@active')->name('users.active');

Route::resource('roles', 'RoleController')->only(['index', 'store', 'update', 'destroy']);

Route::resource('products', 'ProductsController');
Route::get('products/{product}/active')->uses('ProductsController@active')->name('products.active');
Route::get('products/destroyimagen/{imagen_id}/{product_id}', 'ProductsController@destroyimagen')->name('products/destroyimagen');

Route::resource('vitrina', 'VitrinaController')->only(['index', 'show']);
Route::resource('nosotros', 'NosotrosController')->only('index');

Route::resource('categories', 'CategoryController')->only(['index', 'store']);
Route::resource('colors', 'ColorController')->only(['index', 'store']);
Route::resource('sizes', 'SizeController')->only(['index', 'store']);

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Route::post('cart/add', 'CartController@add')->name('cart/add');
Route::get('cart/remove', 'CartController@remove')->name('cart.remove');
Route::resource('cart', 'CartController')->only(['show', 'destroy', 'update']);

Route::resource('orders', 'OrderController');
Route::get('orders/{user}/orders', 'OrderController@showv')->name('orders.showv');
Route::post('orders/resend', 'OrderController@resend')->name('orders.resend');
Route::post('orders/complete', 'OrderController@complete')->name('orders.complete');
Route::post('orders/reversePay', 'OrderController@reversePay')->name('orders.reversePay');
Route::get('orders/{order}/shippingStatus')->uses('OrderController@shippingStatus')->name('orders.shippingStatus');

Route::resource('shipping', 'ShippingController')->only(['create', 'store']);

Route::get('exportUsers', 'ExportController@exportUsers')->name('exportUsers');
Route::get('exportProducts', 'ExportController@exportProducts')->name('exportProducts');
Route::get('exportOrders', 'ExportController@exportOrders')->name('exportOrders');

Route::post('imports/import', 'ImportController@import')->name('import');
Route::get('imports/index', 'ImportController@index')->name('imports.index');
Route::get('imports/indexProducts', 'ImportController@indexProducts')->name('indexProducts');
Route::post('imports/importProducts', 'ImportController@importProducts')->name('importProducts');
