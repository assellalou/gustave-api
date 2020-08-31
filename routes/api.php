<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// auth
Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('register', 'AuthController@register'); //TODO delete this on production
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::get('me', 'AuthController@me');

    Route::post('me/edit', 'AuthController@editProfile');
    Route::post('password/reset', 'AuthController@resetPassword');
});

// student
Route::group([
    'middleware' => 'api',
    'prefix' => 'student'
], function ($router) {
    Route::get('courses', 'StudentController@courses');
});

// teahcers
Route::group([
    'middleware' => ['api', 'teacher'],
    'prefix' => 'teacher',
], function ($router) {
    Route::get('courses', 'TeacherController@allMyCourses');

    Route::post('course/new', 'TeacherController@newCourse');
    Route::post('course/edit/{course}', 'TeacherController@editCourse');
    Route::post('course/delete/{course}', 'TeacherController@deleteCourse');
});

//admin
Route::group([
    'middleware' => ['api', 'admin'],
    'prefix' => 'admin'
], function ($router) {
    //dashboard
    Route::get('dashboard', 'AdminController@admin');
    //lists
    Route::get('classes', 'AdminController@listClasses');
    Route::get('students', 'AdminController@listStudents');
    Route::get('teachers', 'AdminController@listTeachers');
    Route::get('courses', 'AdminController@listCourses');
    // Route::get('teacher/{:id}')
    //add
    Route::post('student/new', 'AdminController@addStudent');
    Route::post('teacher/new', 'AdminController@addteacher');
    Route::post('classe/new', 'AdminController@addClasse');
    Route::post('subject/new', 'AdminController@addSubject');
});
