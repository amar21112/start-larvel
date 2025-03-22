<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Auth::routes(['verify' => true]);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
Route::get('fillable' , 'CrudController@getOffers');

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function() {

    Route::group(['prefix' => 'offers'], function () {
        Route::get('create', 'CrudController@create');

        Route::post('store', 'CrudController@store')->name('offers.store');
        Route::get('all', 'CrudController@getAllOffers')->name('offers.all');

        Route::get('edit/{offer_id}', 'CrudController@editOffer')->name('offers.edit');
        Route::get('delete/{offer_id}', 'CrudController@deleteOffer')->name('offers.delete');
        Route::post('update/{offer_id}', 'CrudController@updateOffer')->name('offers.update');

    });
    Route::get('youtube', 'ShowVideo@getVideo')->name('youtube')->middleware('auth');
});

Route::group(['prefix' => 'ajax-offers'], function () {
    Route::get('create', 'Front\OfferController@create' )->name('ajaxOfferCreate');
    Route::post('store', 'Front\OfferController@store')->name('ajaxOfferStore');
});
