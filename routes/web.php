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

Route::get('/', function () {
    return view('sms');
});
Route::post('/enviarsms','SmsController@enviarsms');
Route::get('/bulcksms',function(){
	return view('bulcksms');
});
Route::post('/saveclient','BulckSmsController@saveclient');
Route::get('/messagebulcksms',function(){
return view('messagebulcksms');
});
Route::post('/savemessagen','BulckSmsController@savemessagen');
Route::get('/sendbulcksms','BulckSmsController@sendbulcksms');
Route::post('/sendsmsfinal','BulckSmsController@sendsmsfinal');