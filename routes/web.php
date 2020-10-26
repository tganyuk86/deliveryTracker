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
Route::get('/driverhome', 'HomeController@driverIndex')->name('driverhome');
Route::get('/map', 'HomeController@gmaps')->name('map');

Route::post('/updatePosition', 'HomeController@updatePosition')->name('updatePosition');

Route::get('/stock', 'HomeController@stock')->name('stock');
Route::get('/stockqe', 'HomeController@stockqe')->name('stockqe');
Route::get('/stockqefor/{id}', 'HomeController@stockqefor');
Route::get('/movestock', 'HomeController@movestock')->name('movestock');
Route::get('/movestock/allHome', 'HomeController@movestockAllHome')->name('movestock/allHome');
Route::post('/performMove', 'HomeController@performMove')->name('performMove');
Route::post('/performPurchase', 'HomeController@performPurchase')->name('performPurchase');
Route::get('/purchase', 'HomeController@purchase')->name('purchase');
Route::get('/allstock', 'HomeController@allstock')->name('allstock');
Route::get('/customers', 'HomeController@customers')->name('customers');
Route::get('/orders', 'HomeController@orders')->name('orders');
Route::get('/editOrder/{id}', 'HomeController@editOrder')->name('editOrder');
Route::get('/cancelOrder/{id}', 'HomeController@cancelOrder')->name('cancelOrder');
//Route::post('/cancelOrder2/{id}', 'HomeController@cancelOrder2')->name('cancelOrder2');
Route::post('/assign', 'HomeController@assignDriver')->name('assignDriver'); 
Route::get('/orders/{id}', 'HomeController@ordersFor')->name('ordersFor');
Route::get('/myOrders', 'HomeController@myOrders')->name('myOrders');
Route::get('/neworder', 'HomeController@neworder')->name('neworder');
Route::get('/neworder/{id}', 'HomeController@newOrderFor')->name('neworderfor');
Route::post('/saveorder', 'HomeController@saveorder')->name('saveorder');
Route::post('/savestock', 'HomeController@savestock')->name('savestock');
Route::post('/savestockqe', 'HomeController@savestockqe')->name('savestockqe');
Route::get('/assignPage/{id}', 'HomeController@showAssign')->name('assignPage');
Route::post('/savePriority', 'HomeController@savePriority')->name('savePriority');

Route::get('/finances', 'HomeController@finances')->name('finances');


Route::get('/rep', 'HomeController@report')->name('report');
Route::post('/report', 'HomeController@loadReport')->name('loadReport');
// Route::post('/assign', 'HomeController@assign')->name('assign');

Route::post('/orders/mark/done', 'HomeController@markDoneForm')->name('mark.doneForm');
Route::get('/orders/mark/done/{id}', 'HomeController@markDone')->name('mark.done');
Route::get('/orders/mark/onroute/{id}', 'HomeController@markOnRoute')->name('mark.onRoute');
