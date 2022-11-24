<?php

namespace App\Http\Controllers\Api\BaseController\Department;

use App\Http\Controllers\Api\BaseProvider\DependencyProvider;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BaseRequest\Department\DepartmentRequest;
use App\Http\Resources\Api\BaseResource\AllDepartmentResource;
use App\Http\Resources\Api\BaseResource\AllDepartmentResourceCollection;
use App\Http\Resources\Api\BaseResource\Department\DepartmentResource;
use App\Http\Resources\Api\BaseResource\Department\DepartmentResourceCollection;
use App\Models\BaseModels\AllDepartment;
use App\Models\BaseModels\Departments\Department;
use App\Models\BaseModels\Departments\EmployeeDepartment;
use App\Models\BaseModels\Employees\Employee;
use App\Models\BaseModels\Pivots\DepartmentsToManagement;
use App\Models\BaseModels\Pivots\EmployeesToDepartment;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;

class DepartmentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Возвращает все отделения ManagementDepartment [mdep]
     *
     * @return Response
     */
    public function index(): Response
    {
        return response(new DepartmentResourceCollection(Department::all()));
    }

    /**
     * Создать новый отдел.
     * @param DepartmentRequest $request
     * @return Response
     */
    public function store(DepartmentRequest $request): Response
    {
        $employeeManager = Employee::find($request->employee_manager_id);
        $employeePrimary = Employee::find($request->employee_primary_manager_id);
        $except = [];
        if ($employeePrimary == null) {
            return \response(['message' => 'Такого сотрудника не существует'], 404);
        }
        if (!DependencyProvider::checkDepartmentEmployee($employeePrimary->rank)) {
            return \response(['message' => 'Сотрудника с таким рангом нельзя добавить в отдел'], 400);
        }
        if ($employeeManager == null) $except[] = 'employee_manager_id';
        else if (!DependencyProvider::checkDepartmentEmployee($employeePrimary->rank)){
            return \response(['message' => 'Сотрудника с таким рангом нельзя добавить в отдел'], 400);
        }
        $department = Department::create($request->safe()->except($except));
        DepartmentsToManagement::create(['department_id' => $department->id, 'management_id' => $request->management_depends]);
        EmployeesToDepartment::create(['department_id' => $department->id, 'employee_id' => $employeePrimary->id,]);
        if ($employeeManager != null) EmployeesToDepartment::create(['department_id' => $department->id, 'employee_id' => $employeeManager->id,]);
        return \response(['message' => 'Отдел успешно создан'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\BaseModels\Departments\Department $mdep
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function show(Department $mdep): Response|Application|ResponseFactory
    {
        return response(new DepartmentResource($mdep));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param \App\Models\BaseModels\Departments\Department $department
     * @return Response
     */
    public function update(Request $request, Department $department)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\BaseModels\Departments\Department $department
     * @return Response
     */
    public function destroy(Department $department)
    {
        //
    }
}
