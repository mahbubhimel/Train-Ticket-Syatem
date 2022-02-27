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
Route::get('/tickets/ticket-data', 'TicketController@getTicketListData');

Route::get('/home', 'TicketSearchController@getTrainListView');
//Route::get('/test/{id}', 'TicketSearchController@test');

Route::get('/train-data', 'TicketSearchController@getSearch');


//executing this route when clicking on buy ticket from ticketsview blade
Route::get('/purchased', 'PurchasedController@pushTicket');

//redirecting this route from PurchasedController.php
//Route::get('/history', function (){
//    return view('purchase');
//});

//executing when clicking on buy ticket
Route::get('purchased-details', 'PurchasedController@ticketDetails');

// executing query for extract purchase history corresponding to specific id for purchase history button click
Route::get('/purchased-history', 'PurchasedController@purchaseView');
Route::get('get-history', 'PurchasedController@purchaseHistory');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
