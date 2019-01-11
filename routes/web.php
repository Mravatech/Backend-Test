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

Route::get('/',  'TicketController@index')->name('index');
Route::post('add-ticket',  'TicketController@add')->name('addTicket');
Route::post('edit-ticket',  'TicketController@update')->name('editTicket');
Route::post('delete-ticket',  'TicketController@delete')->name('deleteTicket');
Route::post('update-ticket-type',  'TicketController@updateTicketType')->name('updateTicketType');
Route::post('add-ticket-type',  'TicketController@addTicketType')->name('addTicketType');

