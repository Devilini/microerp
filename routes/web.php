<?php

use Illuminate\Support\Facades\Route;

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
Auth::routes();
//Route::group(['middleware'	=>	'admin'], function() {
//    Route::get('/users', 'UserController@index')->name('users');
//    Route::get('/user/edit/{id}', 'UserController@edit')->name('user.edit');
//    Route::post('/user/update/{id}', 'UserController@update')->name('user.update');
//    Route::get('/user/delete/{id}', 'UserController@delete')->name('user.delete');
//    Route::get('/user/create', 'UserController@create')->name('user.create');
//    Route::post('/user/store', 'UserController@store')->name('user.store');
//    Route::delete('/user/delete/{id}', 'UserController@delete')->name('user.delete');
//});
Route::group(['middleware'	=>	'admin'], function() {
    Route::resource('/users', 'UserController');
});
