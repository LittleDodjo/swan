<?php

namespace App\Http\Controllers\BaseController\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\BaseRequest\Employee\StoreEmployeeRequest;
use App\Http\Requests\BaseRequest\Employee\UpdateEmployeeRequest;
use App\Http\Resources\BaseResource\Employee\EmployeeResourceCollection;
use App\Http\Resources\BaseResource\Employee\ShortEmployeeResource;
use App\Models\BaseModel\Department\Department;
use App\Models\BaseModel\Department\EmployeeDepartment;
use App\Models\BaseModel\Employee\Employee;
use App\Models\BaseModel\Management\Management;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmployeeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(Employee::class);
    }
    /**
     * Выводит список всех сотрудников, исключа
     *
     * @return Response
     */
    public function index(): Response
    {
        return response(new EmployeeResourceCollection(
            Employee::all()->reject(fn($employee) => $employee->defaultAlways())
        ));
    }

    /**
     * Создать сотрудника
     *
     * @param StoreEmployeeRequest $request
     * @return Response
     */
    public function store(StoreEmployeeRequest $request): Response
    {
        Employee::create($request->validated());
        return response(['message' => 'Сотрудник создан']);
    }

    /**
     * Display the specified resource.
     *
     * @param Employee $employee
     * @return Response
     */
    public function show(Employee $employee): Response
    {
        return response(new ShortEmployeeResource($employee));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateEmployeeRequest $request
     * @param Employee $employee
     * @return Response
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee): Response
    {
        $employee->update($request->validated());
        return response(['message' => 'Данные сотрудника обновлены']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Employee $employee
     * @return Response
     */
    public function destroy(Employee $employee): Response
    {
        if($employee->isManager()){
            return \response(['message' => 'Такой сотрудник является руководителем',], 400);
        }
        $employee->delete();
        return response(['message' => 'Сотрудник удален']);
    }
}
