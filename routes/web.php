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
    $x = "hello BD";
    return view('welcome', compact('x'));
});
Route::get('/get-data', function () {
    $a = [
        'name' => 'Sabbbir'
    ];
    return $a;
});


Route::get('/tickets', 'TicketController@getTicketListView');
Route::get('/ticket-data', 'TicketController@getTicketListData');

Route::get('/home', 'TicketSearchController@getTrainListView');
Route::get('/train-data', 'TicketSearchController@getSearch')->name('train-data');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
