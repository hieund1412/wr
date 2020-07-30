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
    Route::prefix('report')->group(function() {
        Route::get('/', 'ReportController@index')->name('report.index');
        Route::get('getDataReportLatest', 'ReportController@getDataReportLatest')->name('report.getDataReportLatest');
        Route::post('unComplete', 'ReportController@unComplete')->name('report.unComplete');
        Route::post('insertReport', 'ReportController@store')->name('report.insert');
        Route::post('insertWorkingReport', 'ReportController@insertWorkingReport')->name('report.insert-working-report');
    });
});

