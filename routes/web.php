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

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/', 'SmsController@new');
/*Route::get('/', function () {
    return view('welcome');
});*/

/*Route::get('/hoome', function () {
    return view('hope');
});*/

Route::post('/send-sms', [
   'uses'   =>  'SmsController@getUserNumber',
   'as'     =>  'sendSms'
]);

Route::post('/start', [
   'uses'   =>  'SmsController@start',
   'as'     =>  'start'
]);

Route::post('/verify', [
   'uses'   =>  'SmsController@verifyOtp',
   'as'     =>  'verify'
]);