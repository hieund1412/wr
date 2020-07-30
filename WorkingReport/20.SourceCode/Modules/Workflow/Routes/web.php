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
    Route::prefix('workflow')->group(function () {
        Route::get('viewWorkflow', 'WorkflowController@index')->name('workflow.view');
        Route::post('ajax', 'WorkflowController@search')->name('workflow.ajax');
        Route::post('ajax-get-data', 'WorkflowController@getDataSearch')->name('workflow.ajax-get-data');
        Route::post('editData', 'WorkflowController@editDataRow')->name('workflow.edit');
    });
});

