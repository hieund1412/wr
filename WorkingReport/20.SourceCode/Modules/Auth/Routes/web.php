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
Auth::routes();
Route::get('/assets/{module}/{type}/{file}', [ function ($module, $type, $file) {
    $module = ucfirst($module);

    $path = base_path("Modules/$module/Resources/assets/$type/$file");
    if (\File::exists($path)) {
        return response()->download($path, "$file");
    }
    return response()->json([ ], 404);
}]);
Route::prefix('auth')->group(function() {
    Route::get('/', 'AuthController@index')->name('home');
});
Route::get('dang-nhap','LoginController@index')->name('login');
Route::post('/auth/login','LoginController@login')->name('auth.login');

Route::post('dang-xuat','LoginController@logout')->name('logout');

Route::get('quen-mat-khau','ForgotPasswordController@forgot')->name('forgot');
Route::post('quen-mat-khau','ForgotPasswordController@sendResetLinkEmail')->name('forgot.send');

Route::get('khoi-phuc-mat-khau/{email}/{token}','ResetPasswordController@index')->name('password.reset');
Route::post('khoi-phuc-mat-khau/{email}/{token}','ResetPasswordController@resetPassword');

Route::get('/login','LoginController@loginGet')->name('auth.get_login');