<?php

namespace App\Http\Controllers\Api\BaseController\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BaseRequest\Employee\EmployeeRequest;
use App\Http\Requests\Api\BaseRequest\Employee\EmployeeUpdateRequest;
use App\Http\Resources\Api\BaseResource\Employee\EmployeeResource;
use App\Http\Resources\Api\BaseResource\Employee\SmallEmployeeResourceCollection;
use App\Models\BaseModels\Employees\Employee;
use App\Models\BaseModels\Employees\EmployeeDependency;
use Illuminate\Http\Response;

class EmployeeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(Employee::class, 'employee');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        return response(new SmallEmployeeResourceCollection(Employee::all()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param EmployeeRequest $request
     * @return Response
     */
    public function store(EmployeeRequest $request): Response
    {
        $dependency = EmployeeDependency::create();
        Employee::create(
            array_merge($request->validated(), ['employee_dependency_id' => $dependency->id])
        );
        return response(['message' => 'Сотрудник успешно создан',], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Employee $employee
     * @return Response
     */
    public function show(Employee $employee): Response
    {
        return response(new EmployeeResource($employee));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EmployeeUpdateRequest $request
     * @param Employee $employee
     * @return Response
     */
    public function update(EmployeeUpdateRequest $request, Employee $employee): Response
    {
        $employee->update($request->validated());
        return response(['message' => 'Сотрудник успешно изменен', $employee]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Employee $employee
     * @return Response
     */
    public function destroy(Employee $employee): Response
    {
        $employee->delete();
        return response(["message" => 'Сотрудник удален']);
    }
}
