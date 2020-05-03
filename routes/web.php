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

// Authentication routes
Route::get('/login', function () { return view('login'); });
Route::post('/login', 'AuthController@login')->name('login.submit');
Route::get('/sign-in/{user}', 'AuthController@signIn')->name('sign-in');
Route::get('/logout', 'AuthController@logout')->name('logout');