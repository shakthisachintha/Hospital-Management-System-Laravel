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

Route::get('/','HomeController@index');


Auth::routes();


Route::get('/profile', ['as' => 'profile', 'uses' => 'HomeController@profile']);
Route::get('/dash', ['as' => 'dash', 'uses' => 'HomeController@index']);
Route::get('/patient',['as' => 'patient', 'uses' => 'PatientController@index']);
Route::get('/patient_register',['as' => 'patient_register', 'uses' => 'PatientController@register_patient']);

Route::get('/myattend', ['as' => 'myattend', 'uses' => 'AttendController@myattend']);
Route::get('/attendmore', ['as' => 'attendmore', 'uses' => 'AttendController@attendmore']);


