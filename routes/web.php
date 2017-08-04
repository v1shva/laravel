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
Route::group(['middleware' => ['web']], function () {
    Route::get('/song', 'SongController@index')->name('song');
    Route::get('/addSong', 'SongController@addSong')->name('addNewSong');
    Route::post('/registerSong', 'SongController@create')->name('registerSong');
});

