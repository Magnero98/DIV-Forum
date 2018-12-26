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

Auth::routes();

Route::resource('/users', 'UserController');

Route::group(['prefix' => '/popularities/vote', 'as' => 'popularities.'], function (){

    Route::get('/{userId}/Good', 'PopularityController@voteGoodForUser')->name('good');

    Route::get('/{userId}/Bad', 'PopularityController@voteBadForUser')->name('bad');

});

Route::resource('/threads', 'ThreadController')
->only(['store', 'edit', 'update', 'destroy']);

Route::get('/', 'ForumController@index')->name('home');

Route::resource('/forums', 'ForumController');
Route::get('/myforum', 'ForumController@myForum')->name('myForum');
Route::post('/forums/{id}/updateStatus', 'ForumController@updateStatus');
Route::get('/masterForum', 'ForumController@masterForum')->name('masterForum');

Route::resource('/messages', 'MessageController');

Route::resource('categories', 'CategoryController');