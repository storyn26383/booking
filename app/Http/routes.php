<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'BookingController@step1');
Route::get('booking', 'BookingController@step1');
Route::get('booking/room', 'BookingController@step2');
Route::get('booking/data', 'BookingController@step3');
Route::post('booking/confirm', 'BookingController@confirm');
Route::post('booking', 'BookingController@booking');

Route::post('payment/{booking}', 'PaymentController@callback');
Route::post('payment/{booking}/customer', 'PaymentController@customer');
Route::post('payment/{booking}/notify', 'PaymentController@notify');

Route::get('search', 'SearchController@showSearchForm');

Route::get('login', 'Auth\AuthController@showLoginForm');
Route::post('login', 'Auth\AuthController@login');
Route::get('logout', 'Auth\AuthController@logout');
