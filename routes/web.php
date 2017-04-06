<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::resource('', 'MainController');

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/cabinet/cleaner/{id}', 'HomeController@cleanerShow');
Route::get('/cabinet/customer/{id}', 'HomeController@customerShow');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('customer', 'CustomerController');
    Route::resource('booking', 'BookingController');
    Route::resource('cleaner', 'CleanerController');
    Route::get('/home', 'HomeController@index');
    Route::resource('city', 'CityController');
});
