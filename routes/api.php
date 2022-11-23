<?php

use App\Http\Controllers\Api\BaseController\Departments\DepartmentsDependencyController;
use App\Http\Controllers\Api\BaseController\Employee\AppointmentController;
use App\Http\Controllers\Api\BaseController\Employee\EmployeeController;
use App\Http\Controllers\Api\BaseController\Employee\EmployeeDefaultsController;
use App\Http\Controllers\Api\BaseController\Employee\EmployeeDependencyController;
use App\Http\Controllers\Api\BaseController\Employee\ReasonController;
use App\Http\Controllers\Api\BaseController\Managements\ManagementController;
use App\Http\Controllers\Api\BaseController\Managements\ManagementsDependencyController;
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

Route::group(['prefix' => 'dependency'], function ($route) {
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





//Route::group([
//    'middleware' => 'api',
//    'prefix' => 'employee',
//], function ($router) {
//    Route::post('/', [EmployeeController::class, 'newEmployee']);
//    Route::patch('/{employee}', [EmployeeController::class, 'updateRank'])
//        ->missing(fn() => response(['message' => 'Такой сотрудник не найден'], 404));
//    Route::get('/view/{id}', [EmployeeController::class, 'viewEmployee']);
//    Route::get('/view', [EmployeeController::class, 'viewAllEmployees']);
//    Route::get('/defaults', [EmployeeController::class, 'viewDefaultsOnly']);
//    Route::get('/managers', [EmployeeController::class, 'viewManagersOnly']);
//    Route::get('/primary', [EmployeeController::class, 'viewPrimaryOnly']);
//    Route::get('/all/special', [EmployeeController::class, 'viewAllSpecial']);
//});

//Route::group([
//    'middleware' => 'api',
//    'prefix' => 'managment',
//], function ($router) {
//    Route::post('/create', [ManagmentController::class, 'newManagment']);
//    Route::delete('/delete/{id}', [ManagmentController::class, 'deleteManagment']);
//    Route::get('/view/{id}', [ManagmentController::class, 'viewManagment']);
//    Route::get('/view', [ManagmentController::class, 'viewAllManagments']);
//    Route::patch('/change/{id}/employee/depends', [ManagmentController::class, 'changeEmloyeeDepends']);
//    Route::patch('/change/{id}/employee/manager', [ManagmentController::class, 'changeEmployeeManager']);
//
//});
//
//
//Route::group([
//    'middleware' => 'api',
//    'prefix' => 'departament',
//], function ($router) {
//    Route::post('/create', [DepartmentController::class, 'newDepartament']);
//    Route::post('/delete/{id}', [DepartmentController::class, 'deleteDepartament']);
//    Route::get('/view', [DepartmentController::class, 'viewAllDepartaments']);
//    Route::get('/view/{id}', [DepartmentController::class, 'viewDepartament']);
//    Route::get('/employees/{id}', [DepartmentController::class, 'viewEmployees']);
//    Route::post('/assign/{id}', [DepartmentController::class, 'assignNewEmployee']);
//    Route::post('/assign/{id}/remove', [DepartmentController::class, 'removeAssign']);
//    Route::patch('/update/{id}/manager', [DepartmentController::class, 'updateManager']);
//    Route::patch('/update/{id}/primary', [DepartmentController::class, 'updatePrimaryManager']);
//    Route::patch('/update/{id}/depency', [DepartmentController::class, 'updateDepency']);
//    Route::patch('/update/{id}/caption', [DepartmentController::class, 'updateCaption']);
//    Route::patch('/update/{id}/short', [DepartmentController::class, 'updateShortName']);
//    Route::patch('/update/{id}/code', [DepartmentController::class, 'updateCode']);
//});
