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

Route::get('/bands', 'BandController@index');
Route::get('/bands/data', 'BandController@indexData');
Route::get('/bands/edit/{id?}', 'BandController@edit');
Route::post('/bands/update', 'BandController@update');
Route::get('/bands/delete/{id}', 'BandController@delete');
Route::get('/albums', 'AlbumController@index');
Route::get('/albums/data', 'AlbumController@indexData');
Route::get('/albums/edit/{id?}', 'AlbumController@edit');
Route::post('/albums/update', 'AlbumController@update');
Route::get('/albums/delete/{id}', 'AlbumController@delete');
