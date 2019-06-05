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


Auth::routes();
Route::group(['prefix' => 'admin'],function(){
Route::namespace('Admin')->group(function () {
    Route::get('/', 'LoginController@showLoginForm');
    Route::post('/', 'LoginController@login')->name('admin.login');
    Route::get('/logout', 'LoginController@adminLogout')->name('admin.logout');
    Route::get('/dashboard', 'DashboardController@index')->name('admin.dashboard');
    Route::post('/dashboard', 'DashboardController@store')->name('admin.dashboard.upload');
});});

Route::group(['prefix' => 'admin', 'middleware' => 'admin', 'as' => 'admin.' ], function ()
 {
    Route::namespace('Admin')->group(function () {//add admin routes
    Route::resource('apartments', 'ApartmentsController');
    Route::resource('rooms', 'RoomsController');
    Route::get('rooms/remove-image-thumb', 'RoomsController@removeThumbnail')->name('rooms.remove.thumb');
    Route::get('rooms{id}', 'RoomsController@showRoom')->name('rooms.showRoom');
    Route::resource('customers', 'CustomersController');
    Route::resource('employees', 'EmployeesController');
    Route::resource('bookings', 'BookingsController');
    Route::resource('rmBkngs', 'rBookings');
    Route::resource('payments', 'PaymentsController');

    });
});

Route::namespace('Front')->group(function () {
    Route::get('/', 'ApartmentController@index')->name('properties.welcome');
    Route::get('/showrooms{id}', 'HomeController@showRoom')->name('home.showrooms');
    Route::get('/notices', 'HomeController@notices')->name('home.notices');
    Route::get('/services', 'HomeController@services')->name('home.services');

    Route::group(['as' => 'front.' ], function ()
     {
       Route::resource('apartments', 'ApartmentController');
       Route::resource('home', 'HomeController');
       Route::resource('room', 'roomsController');
     });
});

/** messages */
Route::get('/messages', 'ChatsController@fetchMessages');
Route::post('/messages', 'ChatsController@sendMessage');
