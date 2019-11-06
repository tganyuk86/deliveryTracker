<?php

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


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/map', 'HomeController@gmaps')->name('map');

Route::get('/stock', 'HomeController@stock')->name('stock');
Route::get('/locations', 'HomeController@locations')->name('locations');
Route::get('/newlocation', 'HomeController@newlocation')->name('newlocation');
Route::post('/savelocation', 'HomeController@savelocation')->name('savelocation');
Route::post('/savestock', 'HomeController@savestock')->name('savestock');
