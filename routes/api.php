<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['api'])->group(function () {
    Route::post('auth/login', 'LoginController@login');
    Route::post('urls', 'URLController@create');
    Route::get('urls/{code}', 'URLController@code');
    Route::middleware(['auth:api'])->group(function () {
        Route::resource('admin/urls', 'Admin\AdminURLController')->only([
            'index', 'destroy'
        ]);
        Route::get('admin/urls/search', 'Admin\AdminURLController@search');
    });
});
