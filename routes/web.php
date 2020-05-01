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

Route::get('/transport', function () {
    return view('transport');
});

Route::group(['middleware' => 'admin'], function () {
    Route::get('/developer', function () {
        return view('developer');
    });
});

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/users', 'UserController');
Route::get('/profile', 'UserController@showProfile')->name('profile');
Auth::routes();
