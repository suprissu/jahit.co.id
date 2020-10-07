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

Route::get('/', 'PageController@homepage')->name('homepage');
Route::get('/about', 'PageController@aboutpage')->name('aboutpage');

Auth::routes();

Route::group(['prefix' => 'register', 'as' => 'register.'], function () {
    Route::get('/choice', 'Auth\RegisterController@registerChoicePage')->name('choice.page');
});

Route::get('/home', 'HomeController@index')->name('home');
