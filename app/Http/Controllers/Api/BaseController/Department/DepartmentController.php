<?php

namespace App\Http\Controllers\Api\BaseController\Department;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BaseRequest\Department\DepartmentRequest;
use App\Http\Resources\Api\BaseResource\Department\DepartmentResource;
use App\Http\Resources\Api\BaseResource\Department\DepartmentResourceCollection;
use App\Models\BaseModels\Departments\Department;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;

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
        $employees = [];
        foreach ($request->safe()->only(['employee_manager_id', 'employee_primary_manager_id']) as $value) {
            $employees[] = Arr::add([], 'employee_id', $value);
        }
        $department = Department::create($request->validated());
        $department->employees()->createMany($employees);
        return \response($employees);
    }

    /**
     * Display the specified resource.
     *
     * @param Department $mdep
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
     * @param Department $department
     * @return Response
     */
    public function update(Request $request, Department $department)
    {
        //
    }

    /**
     * Удаляет необходимый отдел, над этим методом реализован наблюдатель, который
     * удаляет все связи.
     * @param Department $mdep
     * @return Response
     */
    public function destroy(Department $mdep): Response
    {
        $mdep->delete();
        return response(['message' => 'Отдел удален',]);
    }
}
