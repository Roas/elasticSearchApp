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

Route::get('/', ['as' => 'welcome', 'uses' => 'WelcomeController@index']);
Route::get('/gettest/{id}', ['as' => 'gettest', 'uses' => 'WelcomeController@gettest']);
Route::get('/deletetest/{id}', ['as' => 'deletetest', 'uses' => 'WelcomeController@deletetest']);
Route::post('/result', ['as' => 'result', 'uses' => 'WelcomeController@result']);
Route::get('/readXML', ['as' => 'readXML', 'uses' => 'ReadXMLController@index']);
