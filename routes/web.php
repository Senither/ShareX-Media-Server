<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'HomeController');

// Guest group, this is for when the user is not yet signed in
Route::group(['middleware' => 'guest', 'prefix' => 'cp'], function () {
    Route::get('/login', 'UserController@show');
    Route::post('/login', 'UserController@login');
});

// Auth group, this is for authenticated users
Route::group(['middleware' => 'auth', 'prefix' => 'cp'], function () {
    Route::get('/dashboard', 'AdminController@index');
    Route::post('/dashboard', 'AdminController@update');
    
    Route::get('/user/regenerate-token', 'UserController@updateToken');
    Route::post('/user', 'UserController@update');

    Route::get('/user/create',  'UserAdminController@create');
    Route::post('/user/create', 'UserAdminController@store');
    Route::get('/user/{user}/edit',  'UserAdminController@edit');
    Route::post('/user/{user}/edit', 'UserAdminController@update');

    Route::get('/images', 'ImageAdminController@index');
    Route::get('/images/{id}/delete', 'ImageAdminController@destory');

    Route::get('/logout', 'UserController@destory');
});

Route::get('/{image}/{option?}', 'ImageController@show');
