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
    Route::prefix('projects')->group(function() {
        Route::get('/', 'ProjectsController@index')->name('projects.list');
        Route::get('destroy/{id}','ProjectsController@destroy')
            ->name('projects.destroy');
        Route::post('/insert','ProjectsController@store')->name('projects.insert');
        Route::post('/update','ProjectsController@update')->name('projects.update');
        Route::post('ajaxGetProjects','ProjectsController@ajaxGetProjects')->name('projects.ajaxGetProjects');
        Route::post('ajaxCheckDuplicate', 'ProjectsController@ajaxCheckDuplicate')->name('projects.ajaxCheckDuplicate');
    });
});
