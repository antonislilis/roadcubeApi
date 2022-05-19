<?php

/*
|--------------------------------------------------------------------------
| Store Routes
|--------------------------------------------------------------------------
|
*/
Route::group([
    'prefix' => 'store',
    'middleware' => ['requestLoggerMiddleware'],
    'namespace' => "App\Http\Controllers\\"], function () {
    //See all stores
    Route::get('/all', [
        'uses' => 'StoresController@index',
        'as' => 'showAllStores'
    ]);
    Route::get('/search', [
        'uses' => 'StoresController@search',
        'as' => 'searchStores'
    ]);

});
