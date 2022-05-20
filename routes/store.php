<?php

/*
|--------------------------------------------------------------------------
| Store Routes
|--------------------------------------------------------------------------
|
*/
Route::group([
    'prefix' => 'store',
    'namespace' => "App\Http\Controllers\\"], function () {

    //Create a store (Only admin and logged users have permission)
    Route::post('/create', [
        'uses' => 'StoresController@store',
        'as' => 'store.create',
        'permissions' => ['stores' => ['create']]
    ])->middleware('permissions');

    Route::group([
        'middleware' => ['requestLoggerMiddleware']], function () {
        //See all stores
        Route::get('/all', [
            'uses' => 'StoresController@index',
            'as' => 'strore.all'
        ]);
        //Search stores with filters
        Route::get('/search', [
            'uses' => 'StoresController@search',
            'as' => 'store.search'
        ]);
    });

});
