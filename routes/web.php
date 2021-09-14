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

Route::get('/', 'Auth\LoginController@showLoginForm');

// Route::get('/data-user', 'DataUserController@index')->name('data-user.index');
// Route::get('/data-user/create', 'DataUserController@create')->name('data-user.create');
// Route::post('/data-user/store', 'DataUserController@store')->name('data-user.store');
// Route::get('/data-user/edit/{id}', 'DataUserController@edit')->name('data-user.edit');
// Route::get('/data-user/update/{id}', 'DataUserController@edit')->name('data-user.update');
// Route::get('/data-user/delete/{id}', 'DataUserController@delete')->name('data-user.delete');

Route::resource('data-user', 'DataUserController')->middleware([
    'role:admin',
    'auth',
]);

Route::resource('data-buruh', 'DataBuruhController')->middleware([
    'role:admin',
    'auth',
]);

Route::resource('data-bonus', 'DataBonusController')->middleware([
    'auth',
]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
