<?php

namespace App\Http\Controllers\BaseController\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\BaseRequest\Employee\StoreEmployeeRequest;
use App\Http\Requests\BaseRequest\Employee\UpdateEmployeeRequest;
use App\Http\Resources\BaseResource\Employee\EmployeeResourceCollection;
use App\Models\BaseModel\Employee\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(Employee::class);
    }
    /**
     * Выводит список всех сотрудников,
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(new EmployeeResourceCollection(
            Employee::all()->reject(fn($employee) => $employee->defaultAlways())
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreEmployeeRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BaseModel\Employee\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BaseModel\Employee\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BaseModel\Employee\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
