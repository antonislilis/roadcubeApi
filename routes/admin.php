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

        //Route::get('/properties', 'PropertiesController@index')->name('property.all');
        /*
         * PERMISSIONING ROUTES
         */
        Route::group(['prefix' => 'store', 'middleware' => ['auth', 'permissions'], 'permissions' => ['account_type' => ['is_admin']]], function () {

          //  Route::get('/properties', 'PropertiesController@index')->name('property.all');
            Route::get('/', [
                'uses' => 'StoresController@index',
                'as' => 'showStores',
                'permissions' => ['stores' => ['view']]
            ])->middleware('permissions');

            //Route::post('/create', 'PropertiesController@store')->name('property.store');
            Route::post('/create', [
                'uses' => 'StoresController@store',
                'as' => 'createStore',
                'permissions' => ['stores' => ['create']]
            ])->middleware('permissions');

           /* Route::group(['prefix' => 'properties'], function () {
                Route::get('/list/rents', 'Admin\PropertiesController@index')->name('admin.properties.list');
                Route::get('/create', 'Admin\PropertiesController@create')->name('admin.properties.createView');
                Route::post('/store', 'Admin\PropertiesController@store')->name('admin.properties.store');
            });

            Route::group(['prefix' => 'users'], function () {
                Route::get('/list', 'Admin\UserController@index')->name('admin.users.list');
                Route::get('/create', 'Admin\UserController@create')->name('admin.users.createView');
                Route::get('/profile', 'Admin\UserController@showProfile')->name('admin.users.profile');
            });*/

        });

    });
