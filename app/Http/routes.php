<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'DashboardController@index');

Route::get('/user/{username}', 'DashboardController@userDetail');

Route::get('/slack', 'DashboardController@slack');

Route::get('api/door/change-status', 'DoorController@changeStatusLegacy');
Route::get('door/change-status', 'DoorController@changeStatus');

Route::post('/', 'DashboardController@postMessage');
