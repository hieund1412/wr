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
Route::group(['middleware' => 'auth'], function() {
    Route::prefix('blocks')->group(function() {
        Route::get('/', 'BlocksController@index')->name('block.index');
        Route::post('/insert', 'BlocksController@processInsertBlock')->name('block.insert');
        Route::post('/update', 'BlocksController@processUpdateBlock')->name('block.update');
        Route::get('delete/{id}', 'BlocksController@processDeleteBlock')->name('block.destroy');
        Route::post('ajax-check-duplicate', 'BlocksController@ajaxCheckDuplicateBlock')->name('block.ajaxCheckDuplicateBlock');
    });
});

