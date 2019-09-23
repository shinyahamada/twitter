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

// post
Route::get('/post', 'PostController@index')->name('post_index');
Route::delete('/post/{id}', 'PostController@delete')->name('post_delete');
Route::post('/post', 'PostController@create')->name('post_create');
