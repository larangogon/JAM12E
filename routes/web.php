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

Route::resource('users', 'UserController')->only(['index', 'show', 'edit', 'update']);
Route::get('users/{user}/active')->uses('UserController@active')->name('users.active');

Route::resource('roles', 'RoleController')->only(['index', 'store', 'update', 'destroy']);

Route::get('/home/inactivo', function () { return 'SORRY....USUARIO INHABILITADO';});

Route::resource('products', 'ProductsController');
Route::get('products/{product}/active')->uses('ProductsController@active')->name('products.active');

Route::get('products/destroyimagen/{imagen_id}/{product_id}', 'ProductsController@destroyimagen')
    ->name('products/destroyimagen');

Route::resource('vitrina', 'VitrinaController')->only(['index', 'show']);

Route::resource('nosotros', 'NosotrosController')->only('index');

Route::resource('categories', 'CategoryController')->only(['index', 'store']);
Route::resource('colors', 'ColorController')->only(['index', 'store']);
Route::resource('sizes', 'SizeController')->only(['index', 'store']);

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
