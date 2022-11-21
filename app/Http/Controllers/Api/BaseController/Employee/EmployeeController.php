<?php

namespace App\Http\Controllers\Api\BaseController\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BaseRequest\Employee\EmployeeRequest;
use App\Http\Requests\Api\BaseRequest\Employee\EmployeeUpdateRequest;
use App\Http\Resources\Api\BaseResource\Employee\EmployeeResourceCollection;
use App\Http\Resources\Api\BaseResource\Employee\ShortEmployeeResource;
use App\Http\Resources\Api\BaseResource\Employee\SmallEmployeeResource;
use App\Models\BaseModels\Employees\Employee;
use App\Models\BaseModels\Employees\EmployeeDepency;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(new EmployeeResourceCollection(
            new SmallEmployeeResource(Employee::all())
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
        $depency = EmployeeDepency::create();
        Employee::create(
            array_merge($request->validated(), ['employee_depency_id' => $depency->id])
        );
        return response(['message' => 'Сотрудник успешно создан',], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\BaseModels\Employees\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return response(new ShortEmployeeResource($employee));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BaseModels\Employees\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeUpdateRequest $request, Employee $employee)
    {
        $employee->update($request->validated());
        return response(['message' => 'Сотрудник успешно изменен', $employee, $request->validated(), $request->all()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\BaseModels\Employees\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return response(["message" => 'Сотрудник удален']);
    }
}
