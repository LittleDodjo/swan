<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use  App\Http\Controllers\Api\User\AuthController;
use  App\Http\Controllers\Api\Subsystem\Outgoing\OutDocumentController;
use App\Http\Controllers\Api\User\UserController;
use App\Http\Controllers\Api\User\UserRoleController;

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


//группа роутов администрирования
Route::group([
    'middleware' => 'api',
    'prefix' => 'user/role'
], function ($router) {
    Route::post('/setRole', [UserRoleController::class, 'updateUserRole']);
    Route::post('/setAdmin', [UserRoleController::class, 'setUserAdmin']);
});


// Группа подсистемы исходящей документации

Route::group([
    'middleware' => 'api',
    'prefix' => 'subsystem/outgoing',
],function ($router) {
    Route::get('/document/{id}', [OutDocumentController::class, 'getOutgoingDocument']);
    Route::get('/documents', [OutDocumentController::class, 'getOutgoingDocuments']);
    Route::post('/create', [OutDocumentController::class, 'createOutgoingDocument']);
    Route::post('/change', [OutDocumentController::class, 'changeOutgoingDocument']);
    Route::delete('/delete', [OutDocumentController::class, 'removeOutgoingDocument']);
});
