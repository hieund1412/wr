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
    Route::prefix('statistic')->group(function() {
        Route::get('/employees', 'StatisticController@statisticByEmployees')->name('statistic.employees');
        Route::post('/get-data','StatisticController@getAjaxData')->name('Statistic.get-data');
        Route::post('/search-data','StatisticController@searchData')->name('Statistic.search-data');
    });
});

