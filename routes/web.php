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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/','PostsController@index');

Route::resource('discussions','PostsController');
Route::post('discussions/upload','PostsController@upload');
Route::resource('comments','CommentsController');

Route::get('/user/register', 'UsersController@register');
Route::post('/user/register', 'UsersController@store');
Route::get('/user/login', 'UsersController@login');
Route::post('/user/login', 'UsersController@signin');
Route::get('/user/avatar', 'UsersController@avatar');
Route::post('/user/avatar', 'UsersController@changeAvatar');

Route::get('verify/{confirm_code}', 'UsersController@confirmEmail');

Route::get('/login', 'UsersController@login');
Route::get('/logout', 'UsersController@logout');
