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

Route::get('/', 'HomeController@index');
Route::get('/absen', 'AbsenController@index');
Route::get('/profil', 'PegawaiController@profil');
Route::get('/absen/{jenis}', 'AbsenController@absen');
Route::get('/absen/apel/{id}', 'AbsenController@absenApel');
Route::get('/absen/pagi/{id}', 'AbsenController@absenPagi');
Route::get('/absen/siang/{id}', 'AbsenController@absenSiang');
Route::resource('/pegawai', 'PegawaiController');
Route::resource('/data-absen', 'DataAbsenController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
