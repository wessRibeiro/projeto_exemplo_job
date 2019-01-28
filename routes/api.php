<?php


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

Route::group(['prefix' => 'v1'], function() {

    Route::post('register', 'Api\V1\AuthController@register');
    Route::post('login',    'Api\V1\AuthController@login');
    Route::post('recover',  'Api\V1\AuthController@recover');

    //users
    Route::resource('users', 'Api\V1\UserController');

    Route::group(['middleware' => ['jwt.auth']], function() {
        Route::get('logout', 'Api\V1\AuthController@logout');
    });

});
