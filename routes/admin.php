<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register api/admin routes for your application. These
| routes are loaded by the RouteServiceProvider
|
*/

Route::group(['prefix' => 'admin', 'namespace' => "App\Http\Controllers\Admin\\",], function () {
    /*
     * PERMISSIONING ROUTES
     */
    Route::group([
        'prefix' => 'logs',
        'middleware' => ['auth:api', 'permissions'],
        'permissions' => ['account_type' => ['is_admin']]], function () {

        Route::get('/', [
            'uses' => 'LogController@index',
            'as' => 'showLogs',
            'permissions' => ['admin' => ['show_logs']]
        ])->middleware('permissions');

        Route::delete('/delete', [
            'uses' => 'LogController@destroy',
            'as' => 'clearLogs',
            'permissions' => ['admin' => ['delete_logs']]
        ])->middleware('permissions');

    });

});
