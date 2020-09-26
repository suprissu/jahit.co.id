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
Route::get('/choice', 'PageController@choicePage')->name('userLoginPage');
Route::get('/user/login', 'PageController@userLoginPage')->name('userLoginPage');
Route::get('/user/customer/register', 'PageController@userCustomerRegisterPage')->name('userCustomerRegisterPage');
Route::get('/user/partner/register', 'PageController@userPartnerRegisterPage')->name('userPartnerRegisterPage');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
