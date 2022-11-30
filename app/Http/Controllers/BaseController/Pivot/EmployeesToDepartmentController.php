<?php

namespace App\Http\Controllers\BaseController\Pivot;

use App\Http\Controllers\Controller;
use App\Http\Requests\BaseRequest\Pivot\EmployeesToDepartmentRequest;
use App\Http\Resources\BaseResource\Pivot\EmployeesToDepartmentsResourceCollection;
use App\Models\BaseModel\Department\Department;
use App\Models\BaseModel\Employee\Employee;
use App\Models\BaseModel\Pivot\EmployeesToDepartments;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class EmployeesToDepartmentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }


    /**
     * Добавить сотрудника в отдел
     * @param EmployeesToDepartmentRequest $request
     * @return Response|Application|ResponseFactory
     */
    public function store(EmployeesToDepartmentRequest $request): Response|Application|ResponseFactory
    {
        EmployeesToDepartments::create($request->validated());
        return response(['message' => 'Сотрудник добавлен в отдел']);

    }

    /**
     * Посмотреть всех сотрудников отдела
     * @param Department $department
     * @return Response|Application|ResponseFactory
     */
    public function show(Department $department): Response|Application|ResponseFactory
    {
        return response(new EmployeesToDepartmentsResourceCollection(
            EmployeesToDepartments::where('department_id', $department->id)
                ->get()
                ->reject(function ($employee) {
                    return $employee->employee->defaultAlways();
                })
        ));
    }

    /**
     * Удалить сотрудника из отдела
     * @param Employee $employee
     * @return Response|Application|ResponseFactory
     */
    public function delete(Employee $employee): Response|Application|ResponseFactory
    {
        if ($employee->rank == 3) return \response(['message' => 'Руководителя отдела удалять запрещено'], 400);
        if ($employee->dependency->department_id == null) {
            return \response(['message' => 'Такого сотрудника нет ни в одном отделе']);
        }EmployeesToDepartments::where('employee_id', $employee->id)->first()->delete();
        return response(['message' => 'сотрудник удален из отдела']);
    }


}
