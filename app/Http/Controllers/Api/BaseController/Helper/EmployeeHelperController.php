<?php

namespace App\Http\Controllers\Api\BaseController\Helper;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\BaseResource\Employee\ShortEmployeeResource;
use App\Models\BaseModels\Employees\Employee;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmployeeHelperController extends Controller
{
    public function viewAllEmployees(Request $request): JsonResponse
    {
        $employees = Employee::all()->reject(function ($employee) {
            return !$employee->isOnWork();
        });
        return response()->json(
            new EmployeeResourceCollection(
                new ShortEmployeeResource(
                    $employees
                )
            )
        );
    }

    public function viewDefaultsOnly(Request $request)
    {
        $employees = Employee::all()->reject(function ($employee) {
            return $employee->isOnWork();
        });
        return response()->json(
            new EmployeeResourceCollection(
                new ShortEmployeeResource(
                    $employees
                )
            )
        );
    }

    public function viewManagersOnly(Request $request)
    {
        $employees = Employee::all()->reject(function ($employee) {
            return !$employee->isManager();
        });
        return response()->json(
            new EmployeeResourceCollection(
                new ShortEmployeeResource(
                    $employees
                )
            )
        );
    }

    public function viewPrimaryOnly(Request $request)
    {
        $employees = Employee::all()->reject(function ($employee) {
            return !$employee->isPrimaryManager();
        });
        return response()->json(
            new EmployeeResourceCollection(
                new ShortEmployeeResource(
                    $employees
                )
            )
        );
    }

    public function viewAllSpecial(Request $request)
    {
        $employees = Employee::all()->reject(function ($employee) {
            return !$employee->isManager() || !$employee->isPrimaryManager();
        });
        return response()->json(
            new EmployeeResourceCollection(
                new ShortEmployeeResource(
                    $employees
                )
            )
        );
    }
}
