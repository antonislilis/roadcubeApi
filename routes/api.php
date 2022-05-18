<?php

use Illuminate\Support\Facades\Route;

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

Route::group(
    [
        'prefix'  => 'auth',
        'namespace' => "App\Http\Controllers\Auth\\",
        'middleware' => ['XSS']
    ],
    function(){
        Route::post('signin', 'SignInController');
        Route::post('signout', 'SignOutController');
        Route::post('register', [
            'uses' => 'RegisterController@register',
            'as' => 'register'
        ]);

        Route::get('me', 'MeController');
    }
);

Route::group(['prefix' => 'store', 'namespace' => "App\Http\Controllers\\"], function () {
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

include('admin.php');
