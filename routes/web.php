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

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/', 'ShowRoomsController');

Route::get('admin/home', 'HomeController@adminHome')->name('admin.home')->middleware('is_admin');

Auth::routes(['verify' => true]);

Route::get('/home', 'ShowRoomsController');

Route::get('/rooms/{roomType?}','ShowRoomsController');

Route::resource('roomTypes', 'RoomTypeController');

Route::resource('bookings', 'BookingController');

