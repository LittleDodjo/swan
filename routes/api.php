<?php


use App\Http\Controllers\Api\BaseController\Employee\EmployeeController;
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
    'prefix' => 'admin'
], function ($router) {
    Route::post('/admin', [UserRolesController::class, 'setAsAdmin']);
    Route::post('/root', [UserRolesController::class, 'setAsRoot']);
    Route::post('/manager', [UserRolesController::class, 'setAsControlManager']);
});

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
    'prefix' => 'employee',
], function($router){
    Route::post('/create', [EmployeeController::class, 'newEmployee']);
});


Route::group([
    'middleware' => 'api',
    'prefix' => 'organization',
], function($router){
    Route::post('/create', [OrganizationController::class, 'newOrganization']);

});
