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

Route::get('/', 'EnpostsController@index')->name('enposts.index');

//ユーザ登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

//ログイン認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');


Route::group(['middleware' => ['auth']], function () {
    //投稿
    Route::get('enposts/create', 'EnpostsController@create')->name('enposts.create');
    Route::post('enposts', 'EnpostsController@store')->name('enposts.store');
    //編集
    Route::get('enposts/{id}/edit', 'EnpostsController@edit')->name('enposts.edit');
    Route::put('enposts/{id}', 'EnpostsController@update')->name('enposts.update');
    //削除
    Route::delete('enposts/{id}', 'EnpostsController@destroy')->name('enposts.destroy');
    //投稿詳細
    Route::get('enposts/{id}', 'EnpostsController@show')->name('enposts.show');
    //添削
    Route::get('corrections/{enpost_id}/correct', 'CorrectionsController@correct')->name('corrections.correct');
    Route::post('corrections/{enpost_id}', 'CorrectionsController@uploadcorrection')->name('corrections.uploadcorrection');
    //ユーザ詳細
    Route::get('users/{id}', 'UsersController@show')->name('users.show');
    Route::get('users/{id}/corrections', 'UsersController@showcorrections')->name('users.showcorrections');
});

