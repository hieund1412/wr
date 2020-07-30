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
    Route::prefix('departments')->group(function() {
        Route::get('/', 'DepartmentsController@index')->name('departments.index');
        Route::post('/insert', 'DepartmentsController@processInsertDepartment')->name('departments.insert');
        Route::post('/update', 'DepartmentsController@processUpdateDepartment')->name('departments.update');
        Route::get('/delete/{id}', 'DepartmentsController@processDeleteDepartment')->name('departments.destroy');
        Route::post('ajax-check-duplicate', 'DepartmentsController@ajaxCheckDuplicateDepartment')->name('departments.ajaxCheckDuplicate');
    });
});

