<?php

use App\Http\Controllers\api\v1\AuthController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', [AuthController::class, 'login'])->withoutMiddleware(['auth:api']);
        Route::post('register', [AuthController::class, 'register'])->withoutMiddleware(['auth:api']);
        Route::get('logout', [AuthController::class, 'logout']);
        Route::get('me', [AuthController::class, 'me']);
    });

    Route::get('test', function () {
        return 'its ok';
    });
});
