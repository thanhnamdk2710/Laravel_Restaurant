<?php

Route::get('/', 'HomeController@index')->name('welcome');
Route::post('/reservation', 'ReservationController@reservation')->name('reservation');

Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => 'auth', 'namespace' => 'admin'], function () {
    Route::get('dashboard', 'DashboardController@index')->name('admin.dashboard');
    Route::resource('sliders', 'SliderController');
    Route::resource('categories', 'CategoryController');
    Route::resource('items', 'ItemController');
    Route::get('reservation', 'ReservationController@index')->name('reservation.index');
    Route::post('reservation/{id}', 'ReservationController@status')->name('reservation.status');
    Route::delete('reservation/{id}', 'ReservationController@destroy')->name('reservation.destroy');
});
