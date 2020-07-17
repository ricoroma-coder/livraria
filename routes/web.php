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

// View Control 
Route::get('/', 'ViewControl@index')->name('index');
Route::get('/autores', 'ViewControl@writer')->name('writers');
Route::get('/livros', 'ViewControl@book')->name('books');
Route::get('/editoras', 'ViewControl@pub')->name('pub');

// Dashboard control
Route::get('/dash', 'DashControl@index')->name('dash');

// Ajax Routes
// Search
Route::get('/dash/ajaxSearch', 'DashControl@ajaxSearch')->name('ajaxSearch');
Route::post('/dash/search/{data}', 'DashControl@search')->name('search');
// Redirect
Route::get('/dash/redirect', 'DashControl@redirect')->name('searchRedirect');

// Model Control
// PubCompany
Route::resource('dashPubs', 'PubControl');
Route::post('dashPubs/rating/{id}', 'PubControl@rating')->name('pubRating');
// Writer
Route::resource('dashWriters', 'WriterControl');
Route::post('dashWriters/rating/{id}', 'WriterControl@rating')->name('writerRating');
// Book
Route::resource('dashBooks', 'BookControl');
Route::post('dashBooks/rating/{id}', 'BookControl@rating')->name('bookRating');
