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

Route::get('/home', 'ForumController@index')->name('home');

Route::resource('/forums', 'ForumController');
Route::post('/home/search', 'ForumController@searchForum')->name('search');

Route::resource('/messages', 'MessageController');
Route::get('/messages', 'MessageController@showCurrentUserInbox')->name('inbox');
