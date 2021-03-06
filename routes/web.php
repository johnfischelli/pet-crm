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

Route::get('/', ['uses' => 'Controller@home', 'as' => 'loadCustomer']);
Route::post('/', ['uses' => 'Controller@saveCustomer', 'as' => 'saveCustomer']);
Route::post('/appointment/delete', ['uses' => 'Controller@deleteAppointment', 'as' => 'deleteAppointment']);
