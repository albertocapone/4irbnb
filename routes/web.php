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
Route::get('/show-house/{id}', 'HouseController@show')->name('show-house');
// end
Route::get('/show-personal/{id}', 'HomeController@show')->name('show-personal');
Route::get('/edit-personal/{id}', 'HomeController@edit')->name('edit-personal');
Route::post('/update-personal/{id}', 'HomeController@update')->name('update-personal');
Route::get('/delete-personal/{id}', 'HomeController@delete')->name('delete-personal');
Route::get('/houses-index/{data}', 'HouseController@index')->name('houses-index');
Route::post('/store-message/{house_id}','MessageController@store')->name('store-message');
