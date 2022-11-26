<?php

use App\Http\Controllers\Api\BaseController\Department\DepartmentController;
use App\Http\Controllers\Api\BaseController\Department\DepartmentsDependencyController;
use App\Http\Controllers\Api\BaseController\Employee\AppointmentController;
use App\Http\Controllers\Api\BaseController\Employee\EmployeeController;
use App\Http\Controllers\Api\BaseController\Employee\EmployeeDefaultsController;
use App\Http\Controllers\Api\BaseController\Employee\EmployeeDependencyController;
use App\Http\Controllers\Api\BaseController\Employee\ReasonController;
use App\Http\Controllers\Api\BaseController\Management\ManagementController;
use App\Http\Controllers\Api\BaseController\Management\ManagementsDependencyController;
use App\Http\Controllers\Api\BaseController\OrganizationController;
use App\Http\Controllers\Api\BaseController\User\AuthController;
use App\Http\Controllers\Api\BaseController\User\UserRolesController;
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

Route::group(['prefix' => 'user'], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
});

Route::group(['prefix' => 'role'], function () {
    Route::post('/update/{user}', [UserRolesController::class, 'updateRole'])
        ->missing(fn() => response(['message' => 'Такая учетная запись не найдена'], 404));
    Route::post('/confirm/{user}', [UserRolesController::class, 'confirmUser'])
        ->missing(fn() => response(['message' => 'Такая учетная запись не найдена'], 404));
});

Route::group(['prefix' => 'defaults',], function () {
    Route::post('/{reason}', [EmployeeDefaultsController::class, 'assignDefault'])
        ->missing(fn() => response(['message' => 'Такая причина не найдена'], 404));
    Route::delete('/{default}', [EmployeeDefaultsController::class, 'cancelDefault'])
        ->missing(fn() => response(['Не найдено отсутствия сотрудника'], 404));
    Route::get('/{employee}', [EmployeeDefaultsController::class, 'viewDefault'])
        ->missing(fn() => response(['Такой сотрудник не найден'], 404));
});

Route::group(['prefix' => 'dependency'], function () {
    Route::apiResource('employees', EmployeeDependencyController::class)
        ->missing(fn() => response(['message' => 'Не найдена зависимость'], 404));

    Route::apiResource('departments', DepartmentsDependencyController::class)
        ->missing(fn() => response(['message' => 'Не найдена зависимость'], 404));

    Route::apiResource('managements', ManagementsDependencyController::class)
        ->missing(fn() => response(['message' => 'Не найдена зависимость'], 404));
});

Route::apiResource('organization', OrganizationController::class)
    ->missing(fn() => response(['message' => "Такая организация не найдена"], 404));

Route::apiResource('reason', ReasonController::class)
    ->missing(fn() => response(['message' => 'Такая причина не найдена'], 404));

Route::apiResource('appointment', AppointmentController::class)
    ->missing(fn() => response(['message' => 'Такая должность не найдена'], 404));

Route::apiResource('employee', EmployeeController::class)
    ->missing(fn() => response(['message' => 'Такой сотрудник не найден'], 404));

Route::apiResource('management', ManagementController::class)
    ->missing(fn() => response(['message' => 'Управление не найдено'], 404));

Route::apiResource('mdep', DepartmentController::class)
    ->missing(fn() => response(['message' => 'Такой отдел не найден'], 404));
