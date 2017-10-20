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
Route::get('/result', ['as' => 'result', 'uses' => 'WelcomeController@result']);
Route::get('/article/{id}', ['as' => 'article', 'uses' => 'WelcomeController@article']);
Route::get('/advancedsearch', ['as' => 'advancedsearch', 'uses' => 'AdvancedSearchController@index']);
Route::get('/advancedsearch/result', ['as' => 'advancedsearch.result', 'uses' => 'AdvancedSearchController@result']);