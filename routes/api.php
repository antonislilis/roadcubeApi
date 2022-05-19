<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
*/
Route::group(['middleware' => ['XSS']], function () {

include('auth.php');
include('store.php');
include('admin.php');

});
