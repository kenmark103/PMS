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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::namespace('Admin')->group(function () {
    Route::get('admin', 'LoginController@showLoginForm');
    Route::post('admin', 'LoginController@login')->name('admin.login');
    Route::get('admin/logout', 'LoginController@adminLogout')->name('admin.logout');
    Route::get('admin/dashboard', 'DashboardController@index')->name('admin.dashboard');
    Route::post('admin/dashboard', 'DashboardController@store')->name('admin.dashboard.upload');
});

Route::group(['prefix' => 'admin', 'middleware' => 'admin', 'as' => 'admin.' ], function ()
 {
    Route::namespace('Admin')->group(function () {//add admin routes
    Route::resource('apartments', 'ApartmentsController');
    Route::resource('rooms', 'RoomsController');
    Route::resource('customers', 'CustomersController');
    Route::resource('employees', 'EmployeesController');
    Route::resource('bookings', 'BookingsController');
    });
});
