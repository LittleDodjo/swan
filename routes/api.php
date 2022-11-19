<?php


use App\Http\Controllers\Api\BaseController\Departaments\DepartamentController;
use App\Http\Controllers\Api\BaseController\Employee\AppointmentController;
use App\Http\Controllers\Api\BaseController\Employee\EmployeeController;
use App\Http\Controllers\Api\BaseController\Employee\EmployeeDefaultsController;
use App\Http\Controllers\Api\BaseController\Employee\ReasonController;
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
    'prefix' => 'reason',
], function($router){
    Route::post('/create', [ReasonController::class, 'newReason']);
    Route::delete('/delete/{id}', [ReasonController::class, 'deleteReason']);
    Route::get('/view/{id}', [ReasonController::class, 'viewReason']);
    Route::get('/view', [ReasonController::class, 'viewAllReasons']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'defaults',
], function($router){
    Route::post('/assign', [EmployeeDefaultsController::class, 'assignDefault']);
    Route::post('/cancel', [EmployeeDefaultsController::class, 'cancelDefault']);
    Route::get('/view/{id}', [EmployeeDefaultsController::class, 'viewDefault']);
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
    Route::get('/defaults', [EmployeeController::class, 'viewDefaultsOnly']);
    Route::get('/managers', [EmployeeController::class, 'viewManagersOnly']);
    Route::get('/primary', [EmployeeController::class, 'viewPrimaryOnly']);
    Route::get('/all/special', [EmployeeController::class, 'viewAllSpecial']);

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
