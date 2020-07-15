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

Route::get('/', 'ViewControl@index')->name('index');

Route::get('/autores', 'ViewControl@writer')->name('writers');

Route::get('/livros', 'ViewControl@book')->name('books');

Route::get('/editoras', 'ViewControl@pub')->name('pub');

Route::get('/dash', 'DashControl@index')->name('dash');

Route::resource('dashPubs', 'PubControl');

Route::resource('dashWriters', 'WriterControl');

Route::resource('dashBooks', 'BookControl');