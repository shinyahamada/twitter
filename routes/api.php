<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// ログインユーザ
Route::get('/user', function(){
  return Auth::user();
})->name('user');

// auth
Route::post('/register', 'Auth\RegisterController@register')->name('register');
Route::post('/login', 'Auth\LoginController@login')->name('login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

// user
Route::get('/user/index', 'UserController@index')->name('user_index');
Route::get('/user/{id}', 'UserController@getUser');
Route::post('/user/{id}/update', 'UserController@update')->name('user_update');

// post
Route::get('/post/{id}', 'PostController@index')->name('user_post');
Route::get('/post', 'PostController@timeline')->name('user_timeline');
Route::delete('/post/{id}', 'PostController@delete')->name('post_delete');
Route::post('/post', 'PostController@create')->name('post_create');

// comment
Route::post('/post/{id}/comments', 'PostController@addComment')->name('post.comment');

// like
Route::put('/post/{id}/like', 'PostController@like')->name('post.like');
Route::delete('/post/{id}/like', 'PostController@unlike');
