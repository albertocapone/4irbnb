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
})->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// cambiare rotte e pagine
Route::get('/house-create', 'HouseController@create')->name('house-create');
Route::post('/house-store', 'HouseController@store')->name('house-store');
// end
Route::get('/house-edit{id}', 'HomeController@edit')->name('home-edit');
Route::get('/show-personal/{id}', 'HomeController@show')->name('show-personal');
