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
Route::get('/logout', 'LoginController@logout')->name('logout');
Route::get('/login', 'LoginController@get')->name('login');
Route::get('/social/login/{provider}', 'SociaLoginlController@redirectToProvider')->name('social.login');
Route::get('/social/login/{provider}/callback', 'SociaLoginlController@handleProviderCallback');
Route::post('/login', 'LoginController@post');
Route::get('/lobby', 'LobbyController@index')->name('lobby');
