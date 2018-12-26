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

// << =============== ROUTES TO FORUM =============== >>

Route::get('/', 'ForumController@index')->name('home');
Route::resource('/forums', 'ForumController')
    ->only(['show']);


// << =============== ALL ROUTES INSIDE WOULD CALL isLoggedIn MIDDLEWARE =============== >>

Route::middleware(['isLoggedIn'])->group(function(){

    // << =============== ALL ROUTES INSIDE WOULD CALL isAdmin MIDDLEWARE =============== >>

    Route::middleware(['isAdmin'])->group(function(){

        // << =============== ROUTES TO USER =============== >>

        Route::resource('/users', 'UserController')
            ->only(['index', 'create', 'store', 'destroy']);

    });


    // << =============== ROUTES TO USER =============== >>

    Route::resource('/users', 'UserController')
        ->except(['index', 'create', 'store', 'destroy']);


    // << =============== ROUTES TO FORUM =============== >>

    Route::get('/search', 'ForumController@searchForum')->name('search');
    Route::get('/myforum', 'ForumController@myForum')->name('myForum');
    Route::resource('/forums', 'ForumController')
        ->except(['index', 'show']);
    Route::post('/forums/{id}/updateStatus', 'ForumController@updateStatus');


    // << =============== ROUTES TO THREAD =============== >>

    Route::resource('/threads', 'ThreadController')
        ->only(['store', 'edit', 'update', 'destroy']);


    // << =============== ROUTES TO MESSAGE =============== >>

    Route::resource('/messages', 'MessageController')
        ->only(['index', 'store', 'destroy']);
    Route::get('/messages', 'MessageController@showCurrentUserInbox')->name('inbox');


    // << =============== ROUTES TO POPULARITY =============== >>

    Route::group(['prefix' => '/popularities/vote', 'as' => 'popularities.'], function (){

        Route::get('/{userId}/Good', 'PopularityController@voteGoodForUser')->name('good');
        Route::get('/{userId}/Bad', 'PopularityController@voteBadForUser')->name('bad');

    });

});