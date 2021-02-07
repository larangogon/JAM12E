<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'ApiV1\Auth\AuthController@login');
    Route::post('signup', 'ApiV1\Auth\AuthController@signup');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('logout', 'ApiV1\Auth\AuthController@logout');
        Route::get('user', 'AuthController@user');
        Route::apiResource('product', 'ApiV1\ProductController');
        Route::apiResource('color', 'ApiV1\ColorApiController');
        Route::apiResource('category', 'ApiV1\CategoryApiController');
        Route::apiResource('size', 'ApiV1\SizeApiController');
    });
});
