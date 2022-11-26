<?php

use App\Http\Controllers\BaseController\AuthController;
use App\Http\Controllers\BaseController\Management\ManagementController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'user'], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
});

Route::apiResource('management', ManagementController::class)
    ->missing(fn() => response(['message' => 'Такое управление не найдено'], 404));
