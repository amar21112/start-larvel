<?php

use Illuminate\Support\Facades\Route;
Auth::routes(['verify' => true]);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
Route::get('fillable' , 'CrudController@getOffers');

Route::group(['prefix' => 'offers'],function(){
    Route::get('create' , 'CrudController@create');
    Route::post('store' , 'CrudController@store')->name('offers.store');
});
