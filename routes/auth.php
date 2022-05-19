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
        Route::post('signout', 'SignOutController');
        Route::post('register', [
            'uses' => 'RegisterController@register',
            'as' => 'register'
        ]);

        Route::get('user', 'UserController');
    }
);
