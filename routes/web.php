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

Route::get('/user/avatar', 'UsersController@avatar');
Route::post('/user/avatarUpload', 'UsersController@avatarUpload');
Route::post('/user/avatarCrop', 'UsersController@avatarCrop');
Route::get('user/password', 'UsersController@password');
Route::post('user/passwordEdit', 'UsersController@passwordEdit');
Route::get('user/index', 'UsersController@index');

Route::get('verify/{confirm_token}', 'EmailController@verify');

Route::get('like/{id}', 'LikeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index');

foreach (glob(__DIR__.DIRECTORY_SEPARATOR.'dev'.DIRECTORY_SEPARATOR.'*.php') as $file){
    require $file;
}
