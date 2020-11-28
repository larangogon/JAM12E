<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
        Route::apiResource('product', 'Api\ProductController');
        Route::apiResource('color', 'Api\ColorApiController');
        Route::apiResource('category', 'Api\CategoryApiController');
        Route::apiResource('size', 'Api\SizeApiController');
    });
});

