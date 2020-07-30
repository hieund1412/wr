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
    Route::prefix('permissions')->group(function() {
        Route::get('/', 'PermissionsController@index')->name('permissions.index');
        Route::get('destroy/{id}','PermissionsController@destroy')->name('permissions.destroy');
        Route::get('view_insert','PermissionsController@create')->name('permissions.view');
        Route::get('view_edit/{id}','PermissionsController@update')->name('permissions.edit');
        Route::post('ajaxUpdatePermissionScreen','PermissionsController@ajaxUpdatePermissionScreen')->name('permissions.ajaxUpdatePermissionScreen');
        Route::get('/role','PermissionsController@role')->name('permissions.role');
        Route::get('data_tree/{id}','PermissionsController@getDataTree')->name('permissions.data_tree');
        Route::get('data_tree_insert','PermissionsController@getDataToInsert')->name('permissions.data_tree_insert');
        Route::get('data_t/{id}','PermissionsController@getDataTree')->name('permissions.data_tree_total');
        Route::post('ajaxGetPermissionScreen','PermissionsController@ajaxGetPermissionScreen')->name('permissions.ajaxGetPermissionScreen');
    });
});


