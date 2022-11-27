<?php

use App\Http\Controllers\BaseController\AuthController;
use App\Http\Controllers\BaseController\Department\DepartmentController;
use App\Http\Controllers\BaseController\Department\EmployeeDepartmentController;
use App\Http\Controllers\BaseController\Employee\AppointmentController;
use App\Http\Controllers\BaseController\Employee\ReasonController;
use App\Http\Controllers\BaseController\Management\ManagementController;
use App\Http\Controllers\BaseController\OrganizationController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'user'], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
});

Route::apiResource('management', ManagementController::class)
    ->missing(fn() => response(['message' => 'Такое управление не найдено'], 404));

Route::apiResource('department/edep', EmployeeDepartmentController::class)
    ->missing(fn() => response(['message' => 'Такой отдел не найден'], 404));

Route::apiResource('department/mdep', DepartmentController::class)
    ->missing(fn() => response(['message' => 'Такой отдел не найден'], 404));

Route::apiResource('organization', OrganizationController::class)
    ->missing(fn() => response(['message' => 'Такая организация не найдена'], 404));

Route::apiResource('reason', ReasonController::class)
    ->missing(fn() => response(['message' => 'Такая причина не найдена'], 404));

Route::apiResource('appointment', AppointmentController::class)
    ->missing(fn() => response(['message' => 'Такая должность не найдена'], 404));
