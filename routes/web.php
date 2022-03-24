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
Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('user', 'UserController@index')->name('user.index');
    Route::post('user/ditanggapi', 'UserController@store')->name('user.store');
    Route::get('user/{id}', 'UserController@edit')->name('user.edit');
    Route::post('user/{id}', 'UserController@update')->name('user.update');
    Route::delete('user/{id}', 'UserController@delete')->name('user.delete');

    Route::get('pengaduan', 'PengaduanController@index')->name('pengaduan.index');
    Route::get('pengaduan/ditanggapi', 'PengaduanController@finish')->name('pengaduan.finsih');
    Route::get('pengaduan/{pengaduan}', 'PengaduanController@show')->name('pengaduan.show');
    Route::post('pengaduan/', 'PengaduanController@store')->name('pengaduan.store');
    
    Route::post('/tanggapan', 'TanggapanController@store')->name('tanggapan.store');
});

