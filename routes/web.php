<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Auth::routes(['verify' => true]);

Route::get('/', function () {

    return view('welcome');
});

Route::get('Not-allowed', function () {
    return 'Not-Allowed';
})->name('prevent');

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
    Route::get('all', 'Front\OfferController@getAll')->name('ajaxOfferAll');
    Route::post('delete', 'Front\OfferController@deleteOffer')->name('ajaxOfferDelete');
    Route::get('edit/{offer_id}', 'Front\OfferController@editOffer')->name('ajaxOfferEdit');
    Route::post('update', 'Front\OfferController@updateOffer')->name('ajaxOfferUpdate');
});


########## Authentication and guards ##############
Route::group(['middleware'=>'CheckAge' , 'namespace'=>'Auth'],function(){

Route::get('adult' , 'CustomAuthController@adult')->name('adults');
});
Route::get('site' , 'Auth\CustomAuthController@site')->name('site')->middleware('auth:web');

Route::get('admin' , 'Auth\AdminController@admin')->middleware('auth:admin')->name('admin');
Route::get('admin/login' , 'Auth\AdminController@adminLogin')->name('admin.login');
Route::post('verifiedAdmin' , 'Auth\AdminController@adminLoginVerified')->name('verified.admin.login');
//
//Route::middleware(['web'])->group(function () {
//    Route::get('admin', 'Auth\AdminController@admin')->middleware('auth:admin')->name('admin');
//    Route::get('admin/login', 'Auth\AdminController@adminLogin')->name('admin.login');
//    Route::post('verifiedAdmin', 'Auth\AdminController@adminLoginVerified')->name('verified.admin.login');
//});

