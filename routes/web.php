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
    return view('index');
})->name('index');

Route::get('/autores', function () {
    return view('writers');
})->name('writers');

Route::get('/livros', function () {
    return view('books');
})->name('books');

Route::get('/pub', function () {
    return view('pub');
})->name('pub');