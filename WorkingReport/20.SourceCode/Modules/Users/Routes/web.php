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
Route::group(['middleware' => 'auth'],function (){
    Route::prefix('users')->group(function() {
        Route::get('/', 'UsersController@index')->name('users.index');
        Route::get('/form_insert', 'UsersController@create')->name('users.view');
        Route::post('/insert', 'UsersController@store')->name('users.insert');
        Route::get('/form_edit/{id}', 'UsersController@edit')->name('users.view_edit');
        Route::post('/update/{id}', 'UsersController@update')->name('users.update');
        Route::get('/destroy/{id}', 'UsersController@destroy')->name('users.destroy');
        Route::post('ajax', 'UsersController@search')->name('users.ajax');
        Route::post('ajax-get-data', 'UsersController@getData')->name('users.ajax-get-data');
        Route::get('/startViewUser', 'UsersController@startViewUser')->name('users.startView');
        Route::post('/processInsertUser', 'UsersController@processInsertNewUser')->name('users.insertView');
        Route::post('/ajax-check-email', 'UsersController@checkDuplicateEmail')->name('users.ajax-check-email');
    });
});

