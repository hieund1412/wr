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
    Route::prefix('project-blocks')->group(function() {
        Route::get('/', 'ProjectBlocksController@index')->name('projectblock.index');
        Route::get('destroy/{id}','ProjectBlocksController@destroy')
            ->name('projectblock.destroy');
        Route::post('/update','ProjectBlocksController@update')->name('projectblock.update');
        Route::post('/insert','ProjectBlocksController@store')->name('projectblock.insert');
        Route::post('ajaxGetProjectBlock','ProjectBlocksController@ajaxGetProjectBlock')->name('projectblock.ajaxGetProjectBlock');
        Route::post('ajax-check-Duplicate-PjB', 'ProjectBlocksController@ajaxCheckDuplicatePjB')->name('projects.ajaxCheckDuplicatePjB');
    });
});
