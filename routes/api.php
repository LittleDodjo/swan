<?php


use App\Http\Controllers\Api\BaseController\Departaments\DepartamentController;
use App\Http\Controllers\Api\BaseController\Departaments\DepartamentDepencyController;
use App\Http\Controllers\Api\BaseController\Employee\AppointmentController;
use App\Http\Controllers\Api\BaseController\Employee\EmployeeController;
use App\Http\Controllers\Api\BaseController\Employee\EmployeeDefaultsController;
use App\Http\Controllers\Api\BaseController\Employee\EmployeeDepencyController;
use App\Http\Controllers\Api\BaseController\Employee\ReasonController;
use App\Http\Controllers\Api\BaseController\Managments\ManagmentController;
use App\Http\Controllers\Api\BaseController\Managments\ManagmentDepencyController;
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

Route::group([
    'middleware' => 'api',
    'prefix' => 'user'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'role'
], function ($router) {
    Route::post('/update', [UserRolesController::class, 'updateRole']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'defaults',
], function ($router) {
    Route::post('/{reason}', [EmployeeDefaultsController::class, 'assignDefault'])
        ->missing(function () {
            return response(['message' => 'Такая причина не найдена'], 404);
        });
    Route::delete('/{default}', [EmployeeDefaultsController::class, 'cancelDefault'])
        ->missing(function () {
            return response(['Не найдено отсутствия сотрудника'], 404);
        });
    Route::get('/{employee}', [EmployeeDefaultsController::class, 'viewDefault'])
        ->missing(function () {
            return response(['Такой сотрудник не найден'], 404);
        });;
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'depency'
], function($route){
    Route::apiResource('employees', EmployeeDepencyController::class)
        ->missing(fn() => response(['message' => 'Не найдена зависимость'], 404));

    Route::apiResource('departament', DepartamentDepencyController::class)
        ->missing(fn() => response(['message' => 'Не найдена зависимость'], 404));

    Route::apiResource('managment', ManagmentDepencyController::class)
        ->missing(fn() => response(['message' => 'Не найдена зависимость'], 404));
});

Route::apiResource('organization', OrganizationController::class)
    ->missing(fn() => response(['message' => "Такая организация не найдена"], 404));

Route::apiResource('reason', ReasonController::class)
    ->missing(fn () => response(['message' => 'Такая причина не найдена'], 404));

Route::apiResource('appointment', AppointmentController::class)
    ->missing(fn () => response(['message' => 'Такая должность не найдена'], 404));

Route::apiResource('employee', EmployeeController::class)
    ->missing(fn () => response(['message' => 'Такой сотрудник не найден'], 404));









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

Route::group([
    'middleware' => 'api',
    'prefix' => 'managment',
], function ($router) {
    Route::post('/create', [ManagmentController::class, 'newManagment']);
    Route::delete('/delete/{id}', [ManagmentController::class, 'deleteManagment']);
    Route::get('/view/{id}', [ManagmentController::class, 'viewManagment']);
    Route::get('/view', [ManagmentController::class, 'viewAllManagments']);
    Route::patch('/change/{id}/employee/depends', [ManagmentController::class, 'changeEmloyeeDepends']);
    Route::patch('/change/{id}/employee/manager', [ManagmentController::class, 'changeEmployeeManager']);

});


Route::group([
    'middleware' => 'api',
    'prefix' => 'departament',
], function ($router) {
    Route::post('/create', [DepartamentController::class, 'newDepartament']);
    Route::post('/delete/{id}', [DepartamentController::class, 'deleteDepartament']);
    Route::get('/view', [DepartamentController::class, 'viewAllDepartaments']);
    Route::get('/view/{id}', [DepartamentController::class, 'viewDepartament']);
    Route::get('/employees/{id}', [DepartamentController::class, 'viewEmployees']);
    Route::post('/assign/{id}', [DepartamentController::class, 'assignNewEmployee']);
    Route::post('/assign/{id}/remove', [DepartamentController::class, 'removeAssign']);
    Route::patch('/update/{id}/manager', [DepartamentController::class, 'updateManager']);
    Route::patch('/update/{id}/primary', [DepartamentController::class, 'updatePrimaryManager']);
    Route::patch('/update/{id}/depency', [DepartamentController::class, 'updateDepency']);
    Route::patch('/update/{id}/caption', [DepartamentController::class, 'updateCaption']);
    Route::patch('/update/{id}/short', [DepartamentController::class, 'updateShortName']);
    Route::patch('/update/{id}/code', [DepartamentController::class, 'updateCode']);
});
