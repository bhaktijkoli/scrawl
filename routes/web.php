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

Route::get('/', 'HomeController@get')->name('home');
Route::get('/login', 'LoginController@get')->name('login');
Route::post('/login', 'LoginController@post');
Route::get('/find', 'HomeController@get')->name('find');
