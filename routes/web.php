<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

define('PAGINATION_COUNT', 4);
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


# RELATION
Route::group(['namespace'=>'Relations'],function(){
    // one to one
    Route::get('has-one' ,'RelationController@hasOneRelation');
    Route::get('has-one-reverse' ,'RelationController@hasOneRelationReverse');
    Route::get('users-with-phones' ,'RelationController@getUserHasPhone');
    Route::get('users-without-phone' ,'RelationController@getUserWithoutPhone');

    // one to many
    Route::get('hospital-has-many' , 'RelationController@getHospitalDoctors');
    Route::get('hospitals' , 'RelationController@getAllHospitals')->name('hospitals');
    Route::get('doctors' , 'RelationController@getAllDoctors')->name('doctors');

    Route::get('doctors/{hospital_id}' , 'RelationController@getAllDoctorsOfHospital')->name('doctorsOfHospital');
    Route::get('doctor-service/{doctor_id}' , 'RelationController@getDoctorServiceById')->name('serviceOfDoctor');

    Route::get('delete-hospital/{hospital_id}' , 'RelationController@deleteHospital')->name('delete.hospital');
    Route::get('delete-doctor/{doctor_id}' , 'RelationController@deleteDoctor')->name('delete.doctor');

    Route::get('hospital_has_doctors' , 'RelationController@getHospitalsHasDoctors');
    Route::get('hospital_has_doctors_male' , 'RelationController@getHospitalsHasDoctorsMales');
    Route::get('hospital_Not_has_doctors' , 'RelationController@getHospitalsNotHasDoctors');

    Route::get('doctor-services' , 'RelationController@getDoctorServices');
    Route::get('service-doctors' , 'RelationController@getServiceDoctors');

    Route::get('add-service-doctor/{doctor_id}' , 'RelationController@addServiceDoctor')->name('add.service.doctor');
    Route::post('save-adding-service' , 'RelationController@storeServiceDoctor')->name('store.service.doctor');


    ######## has one through

    Route::get('has-one-through' , 'RelationController@getPatientDoctor')->name('get.patient.doctor');
    Route::get('has-many-through' , 'RelationController@getCountryDoctors')->name('get.county.doctors');
});



