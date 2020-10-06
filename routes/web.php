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
Route::get('/user/login', 'PageController@userLoginPage')->name('userLoginPage');
Route::get('/user/register', 'PageController@userRegisterPage')->name('userRegisterPage');
Route::get('/user/choice', 'PageController@choicePage')->name('choicePage');
Route::get('/user/customer/register', 'PageController@userCustomerRegisterPage')->name('userCustomerRegisterPage');
Route::get('/user/customer/add-project', 'PageController@userCustomerAddProjectPage')->name('userCustomerAddProjectPage');
Route::get('/user/customer/project', 'PageController@userCustomerProjectPage')->name('userCustomerProjectPage');
Route::get('/user/customer/transaction', 'PageController@userCustomerTransactionPage')->name('userCustomerTransactionPage');
Route::get('/user/partner/register', 'PageController@userPartnerRegisterPage')->name('userPartnerRegisterPage');
Route::get('/notfound', 'PageController@notfound')->name('notfound');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
