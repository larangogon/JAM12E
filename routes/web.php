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

Route::get('/home', 'AdminV1\HomeController@index')
    ->name('home')
    ->middleware('verified', 'Status');

Route::resource('users', 'AdminV1\UserController');
Route::get('users/{user}/active')
    ->uses('AdminV1\UserController@active')
    ->name('users.active');

Route::resource('roles', 'AdminV1\RoleController')
    ->only(['index', 'store', 'update', 'destroy']);

Route::resource('products', 'AdminV1\ProductsController');
Route::get('products/{product}/active')
    ->uses('AdminV1\ProductsController@active')
    ->name('products.active');
Route::get('products/destroyimagen/{imagen_id}/{product_id}')
    ->uses('AdminV1\ProductsController@destroyimagen')
    ->name('products/destroyimagen');

Route::resource('vitrina', 'AdminV1\StoreController')
    ->only(['index', 'show']);
Route::resource('nosotros', 'AdminV1\WeController')
    ->only('index');
Route::get('nosotros/indexApi', 'AdminV1\WeController@indexApi')
    ->name('nosotros.indexApi');

Route::resource('categories', 'AdminV1\CategoryController')
    ->only(['index', 'store']);
Route::resource('colors', 'AdminV1\ColorController')
    ->only(['index', 'store']);
Route::resource('sizes', 'AdminV1\SizeController')
    ->only(['index', 'store']);

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Route::post('cart/add', 'AdminV1\CartController@add')
    ->name('cart/add');
Route::get('cart/remove', 'AdminV1\CartController@remove')
    ->name('cart.remove');
Route::resource('cart', 'AdminV1\CartController')
    ->only(['show', 'destroy', 'update']);

Route::resource('orders', 'AdminV1\OrderController');
Route::get('orders/{user}/orders', 'AdminV1\OrderController@showv')
    ->name('orders.showv');
Route::post('orders/resend', 'AdminV1\OrderController@resend')
    ->name('orders.resend');
Route::post('orders/complete', 'AdminV1\OrderController@complete')
    ->name('orders.complete');
Route::post('orders/reversePay', 'AdminV1\OrderController@reversePay')
    ->name('orders.reversePay');
Route::post('orders/paymentInStore', 'AdminV1\OrderController@paymentInStore')
    ->name('orders.paymentInStore');
Route::get('orders/{order}/shippingStatus')
    ->uses('AdminV1\OrderController@shippingStatus')
    ->name('orders.shippingStatus');
Route::post('orders/cancellerOrderStore', 'AdminV1\OrderController@cancellerOrderStore')
    ->name('cancellerOrderStore');

Route::get('canceller')
    ->uses('AdminV1\OrderController@canceller')
    ->name('orders.canceller');
Route::resource('shipping', 'AdminV1\ShippingController')
    ->only(['create', 'store']);

Route::get('exportUsers', 'AdminV1\ExportController@exportUsers')
    ->name('exportUsers');
Route::get('exportProducts', 'AdminV1\ExportController@exportProducts')
    ->name('exportProducts');
Route::get('exportOrders', 'AdminV1\ExportController@exportOrders')
    ->name('exportOrders');
Route::get('reportGeneralExport', 'AdminV1\ExportController@reportGeneralExport')
    ->name('reportGeneralExport');
Route::get('reportProductExport', 'AdminV1\ExportController@reportProductExport')
    ->name('reportProductExport');
Route::post('/ruteExcel', 'AdminV1\ExportController@ruteExcel')
    ->name('ruteExcel');

Route::post('imports/import', 'AdminV1\ImportController@import')
    ->name('import');
Route::get('imports/index', 'AdminV1\ImportController@index')
    ->name('imports.index');
Route::get('imports/indexProducts', 'AdminV1\ImportController@indexProducts')
    ->name('indexProducts');
Route::post('imports/importProducts', 'AdminV1\ImportController@importProducts')
    ->name('importProducts');
Route::post('imports/imgsProducts', 'AdminV1\ImportController@imgsProducts')
    ->name('imgsProducts');


Route::post('/reportOrders-pdf', 'AdminV1\ReportController@reportOrders')
    ->name('reportOrders');
Route::get('/reportGeneral-pdf', 'AdminV1\ReportController@reportGeneral')
    ->name('reportGeneral');
Route::post('/rute', 'AdminV1\ReportController@rute')
    ->name('rute');
Route::resource('reports', 'AdminV1\ReportController')
    ->only('show', 'index', 'destroy');

Route::get('metrics', 'AdminV1\MetricController@index')
    ->name('metrics.index');
Route::get('metrics/{metric}', 'AdminV1\MetricController@show')
    ->name('metrics.show');

Route::post('products/{product}/rate', 'AdminV1\ProductRatingController@rate')
    ->name('rate');
Route::post('products/{product}/unrate', 'AdminV1\ProductRatingController@unrate')
    ->name('unrate');

Route::resource('notifications', 'AdminV1\NotificationController')
    ->only('index');
Route::post('/mark-as-read', 'AdminV1\NotificationController@markNotification')
    ->name('markNotification');

Route::resource('messages', 'AdminV1\MessagesController')
    ->only('index', 'store', 'destroy', 'show', 'create');
Route::get('messages/response/{id}', 'AdminV1\MessagesController@response')
    ->name('messages.response');

Route::resource('spendings', 'AdminV1\SpendingController');

Route::get('lang/{lang}', 'LanguageController@swap')
    ->name('lang.swap');

Route::get('/phpinfo', function () {
    phpinfo();
});
