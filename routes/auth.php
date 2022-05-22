<?php

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
|
*/

Route::group(
    [
        'prefix' => 'auth',
        'namespace' => "App\Http\Controllers\Auth\\",
    ],
    function () {
        
        Route::post('signin', 'SignInController');

        Route::post('register', [
            'uses' => 'RegisterController@register',
            'as' => 'register'
        ]);

        Route::group(
            [
                'middleware' => 'auth',
            ],
            function () {

                Route::post('signout', 'SignOutController');

                Route::get('user', 'UserController');
            });
    }
);
