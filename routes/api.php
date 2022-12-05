<?php

use App\Http\Controllers\BaseController\AuthController;
use App\Http\Controllers\BaseController\Department\AllDepartmentController;
use App\Http\Controllers\BaseController\Department\DepartmentController;
use App\Http\Controllers\BaseController\Department\EmployeeDepartmentController;
use App\Http\Controllers\BaseController\Employee\AppointmentController;
use App\Http\Controllers\BaseController\Employee\DefaultController;
use App\Http\Controllers\BaseController\Employee\EmployeeController;
use App\Http\Controllers\BaseController\Employee\EmployeeDefaultsController;
use App\Http\Controllers\BaseController\Employee\ReasonController;
use App\Http\Controllers\BaseController\Management\ManagementController;
use App\Http\Controllers\BaseController\OrganizationController;
use App\Http\Controllers\BaseController\Pivot\EmployeesToDepartmentController;
use App\Http\Controllers\BaseController\Pivot\EmployeesToEmployeeDepartmentsController;
use App\Http\Controllers\BaseController\UserRoleController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'user'], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/employee/{email}', [AuthController::class, 'email']);
    Route::post('/role/{user}', [UserRoleController::class, 'role'])
        ->missing(fn() => response(['not found']));
    Route::post('/confirm/{user}', [UserRoleController::class, 'confirm'])
        ->missing(fn() => response(['not found']));
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

Route::apiResource('default', EmployeeDefaultsController::class)
    ->missing(fn() => response(['message' => 'Отсутствие не найдено']));

Route::apiResource('employee', EmployeeController::class)
    ->missing(fn() => response(['message' => 'Такой сотрудник не найден']));

Route::post('mdep', [EmployeesToDepartmentController::class, 'store']);

Route::get('mdep/{department}', [EmployeesToDepartmentController::class, 'show'])
    ->missing(fn() => response(['message' => 'Отдел не найден'], 404));

Route::delete('mdep/{employee}', [EmployeesToDepartmentController::class, 'delete'])
    ->missing(fn() => response(['message' => 'Сотрудник не найден'], 404));

Route::post('edep', [EmployeesToEmployeeDepartmentsController::class, 'store']);

Route::get('edep/{department}', [EmployeesToEmployeeDepartmentsController::class, 'show'])
    ->missing(fn() => response(['message' => 'Отдел не найден'], 404));

Route::delete('edep/{employee}', [EmployeesToEmployeeDepartmentsController::class, 'delete'])
    ->missing(fn() => response(['message' => 'Сотрудник не найден'], 404));

Route::get('all/departments', [AllDepartmentController::class, 'index']);
