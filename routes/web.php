<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
Route::get('/houses-index', 'HouseController@index')->name('houses-index'); //ok
Route::get('/show-house/{id}', 'HouseController@show')->name('show-house');  //ok

Route::get('/home', 'HomeController@index')->name('home'); //ok
Route::get('/house-create', 'HomeController@create')->name('house-create'); //ok
Route::any('/house-store', 'HomeController@store')->name('house-store'); //ok
Route::get('/show-personal/{id}', 'HomeController@show')->name('show-personal'); //ok
Route::get('/edit-personal/{id}', 'HomeController@edit')->name('edit-personal'); //ok
Route::get('/set-personal-visibility/{id}', 'HomeController@setVisibility'); //ok
Route::any('/update-personal/{id}', 'HomeController@update')->name('update-personal'); //ok
Route::get('/delete-personal/{id}', 'HomeController@delete')->name('delete-personal'); //ok
Route::any('/store-message/{house_id}','MessageController@store')->name('store-message'); //ok
Route::get('/ad-payment/{house_id}', 'PaymentController@transaction')->name('ad-payment'); //ok
Route::any('/checkout/{house_id}', 'PaymentController@checkout')->name('checkout'); //ok
Route::get('/get-stats', 'StatsController@get'); //ok
Route::get('/stats-index/{house_id}', 'StatsController@index')->name('stats-index'); //ok
Route::get('/msg-index/{house_id}', 'MessageController@index')->name('msg-index');  //ok