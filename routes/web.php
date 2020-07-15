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

// cambiare rotte e pagine
Route::get('/houses-index', 'HouseController@index')->name('houses-index');
Route::get('/show-house/{id}', 'HouseController@show')->name('show-house');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/house-create', 'HomeController@create')->name('house-create');
Route::post('/house-store', 'HomeController@store')->name('house-store');
Route::get('/show-personal/{id}', 'HomeController@show')->name('show-personal');
Route::get('/edit-personal/{id}', 'HomeController@edit')->name('edit-personal');
Route::post('/update-personal/{id}', 'HomeController@update')->name('update-personal');
Route::get('/delete-personal/{id}', 'HomeController@delete')->name('delete-personal');
Route::post('/store-message/{house_id}','MessageController@store')->name('store-message');
Route::get('/msg-index/{house_id}', 'MessageController@index')->name('msg-index');
Route::get('/stats-index/{house_id}', 'StatsController@index')->name('stats-index');
Route::get('/ad-payment/{house_id}', 'PaymentController@transaction')->name('ad-payment');
Route::post('/checkout/{house_id}', 'PaymentController@checkout')->name('checkout');
