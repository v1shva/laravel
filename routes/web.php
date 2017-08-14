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
Route::group(['middleware' => ['web','auth']], function () {
    Route::get('/song', 'SongController@index')->name('song');
    Route::get('/addSong', 'SongController@addSong')->name('addNewSong');
    Route::post('/rankSong', 'SongController@rankSong')->name('rank');
    Route::post('/searchSongs', 'SongController@searchSongs')->name('searchSongs');
    Route::post('/registerSong', 'SongController@create')->name('registerSong');
});

Route::get('/home', 'HomeController@index')->name('home');

/*Route::get('songs/{file_name}', function($file_name = null)
{
    $path = storage_path().'/'.'app'.'/files/'.$file_name;
    if (file_exists($path)) {
        return Response::download($path);
    }
});*/

