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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/getCategory/{type}', 'TransactionController@getCategory')->name('getCategory');
Route::get('/transaction/filter/', 'TransactionController@filterDate')->name('transaction.filterDate');
Route::resource('category', 'CategoryController');
Route::resource('transaction', 'TransactionController');
Auth::routes();