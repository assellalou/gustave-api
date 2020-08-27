<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// auth
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

// student
Route::group([
    'middleware' => 'api',
    'prefix' => 'student'
], function ($router) {
    Route::get('dashboard', 'StudentController@student');
}); 

// teahcers
Route::group([
    'middleware' => 'api',
    'prefix' => 'teacher',
], function ($router) {
    Route::get('dashboard', 'TeacherController@teacher')->middleware('teacher');
});

// admin
Route::group([
    'middleware' => 'api',
    'prefix' => 'admin'
], function ($router) {
    Route::get('dashboard', 'AdminController@admin')->middleware('admin');
});
