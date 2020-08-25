<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// user
Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});

// admin
Route::group([
    'middleware' => 'api',
    'prefix' => 'admin'
], function ($router) {
    Route::get('dashboard', 'AdminController@admin')->middleware('admin');
});

//students
