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
    Route::prefix('jobs')->group(function() {
        Route::get('/', 'JobsController@index')->name('jobs.index');
        Route::get('destroy/{id}','JobsController@destroy')
            ->name('jobs.destroy');
        Route::post('/insert','JobsController@store')->name('jobs.insert');
        Route::post('/update','JobsController@update')->name('jobs.update');
        Route::post('ajaxGetJobs','JobsController@ajaxGetJobs')->name('jobs.ajaxGetJobs');
        Route::post('ajax-check-duplicate','JobsController@ajaxCheckDuplicateJob')->name('projects.ajaxCheckDuplicateJob');
    });
});
