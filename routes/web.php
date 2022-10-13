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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/app/notifications', 'NotificationController@index')->name('home');
Route::post('/app/notifications/{id}/mark-as-read', 'NotificationController@markAsRead');
Route::post('/app/notifications/mark-all-as-read', 'NotificationController@markAllAsRead');


