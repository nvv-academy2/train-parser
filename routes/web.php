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


Route::get('parser', 'ParserController@parse');
Route::post('parser/search', 'ParserController@search');
Route::get('cities/search', "CitiesController@get");
Route::resource('cities', "CitiesController");