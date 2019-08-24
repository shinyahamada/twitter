<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// ----▽▽▽▽ API URL ▽▽▽▽----

// ----△△△△ API URL △△△△----


// ----▽▽▽▽ html返すURL ▽▽▽▽----

// APIのURL以外のリクエストに対してはindexテンプレートを返す らしい
// 画面遷移はフロントエンドのVueRouterが制御する らしい

Route::get('/{any?}', function () {
    return view('index');
})->where('any', '.+');

// ----△△△△ html返すURL △△△△----
