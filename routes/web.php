<?php

Route::get('/', 'HomeController@index')->name('welcome');
Route::post('/reservation', 'ReservationController@reservation')->name('reservation');
Route::post('/contact', 'ContactController@sendMessage')->name('contacts.send');

Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => 'auth', 'namespace' => 'admin'], function () {
    Route::get('dashboard', 'DashboardController@index')->name('admin.dashboard');
    Route::resource('sliders', 'SliderController');
    Route::resource('categories', 'CategoryController');
    Route::resource('items', 'ItemController');

    Route::get('reservation', 'ReservationController@index')->name('reservation.index');
    Route::post('reservation/{id}', 'ReservationController@status')->name('reservation.status');
    Route::delete('reservation/{id}', 'ReservationController@destroy')->name('reservation.destroy');

    Route::get('contacts', 'ContactController@index')->name('contacts.index');
    Route::get('contacts/{id}', 'ContactController@show')->name('contacts.show');
    Route::delete('contacts/{id}', 'ContactController@destroy')->name('contacts.destroy');
});
