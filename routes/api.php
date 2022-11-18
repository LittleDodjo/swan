<?php


use App\Http\Controllers\Api\BaseController\Departaments\DepartamentController;
use App\Http\Controllers\Api\BaseController\Employee\AppointmentController;
use App\Http\Controllers\Api\BaseController\Employee\EmployeeController;
use App\Http\Controllers\Api\BaseController\Managnents\ManagmentController;
use App\Http\Controllers\Api\BaseController\OrganizationController;
use App\Http\Controllers\Api\BaseController\User\AuthController;
use App\Http\Controllers\Api\BaseController\User\UserRolesController;
use Illuminate\Http\Request;
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
    'prefix' => 'admin'
], function ($router) {
    Route::post('/admin', [UserRolesController::class, 'setAsAdmin']);
    Route::post('/root', [UserRolesController::class, 'setAsRoot']);
    Route::post('/manager', [UserRolesController::class, 'setAsControlManager']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'organization',
], function($router){
    Route::post('/create', [OrganizationController::class, 'newOrganization']);
    Route::patch('/update/{id}', [OrganizationController::class, 'updateOrganization']);
    Route::delete('/delete/{id}', [OrganizationController::class, 'deleteOrganization']);
    Route::get('/view/{id}', [OrganizationController::class, 'viewOrganization']);
    Route::get('/view', [OrganizationController::class, 'viewAllOrganizations']);

});

Route::group([
    'middleware' => 'api',
    'prefix' => 'appointment',
], function($router){
    Route::post('/create', [AppointmentController::class, 'newAppointment']);
    Route::delete('/delete/{id}', [AppointmentController::class, 'deleteAppointment']);
    Route::get('/view/{id}', [AppointmentController::class, 'viewAppointment']);
    Route::get('/view', [AppointmentController::class, 'viewAllAppointment']);
    Route::patch('/update/caption', [AppointmentController::class, 'updateCaption']);
    Route::patch('/update/short', [AppointmentController::class, 'updateShortName']);
    Route::patch('/update/manager', [AppointmentController::class, 'updateManager']);
    Route::patch('/update/primary', [AppointmentController::class, 'updatePrimaryManager']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'employee',
], function($router){
    Route::post('/create', [EmployeeController::class, 'newEmployee']);
    Route::get('/view/{id}', [EmployeeController::class, 'viewEmployee']);
    Route::get('/view', [EmployeeController::class, 'viewAllEmployees']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'managment',
], function($router){
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
], function($router){
    Route::post('/create', [DepartamentController::class, 'newDepartament']);
    Route::post('/delete/{id}', [DepartamentController::class, 'deleteDepartament']);
    Route::get('/view/{id}', [DepartamentController::class, 'viewDepartament']);
    Route::get('/view', [DepartamentController::class, 'viewAllDepartaments']);
    Route::get('/mdep', [DepartamentController::class, 'viewManagmentDepartaments']);
    Route::get('/edep', [DepartamentController::class, 'viewEmployeeDepartaments']);
    Route::get('/employees/{id}', [DepartamentController::class, 'viewEmployees']);
});
