<?php

namespace App\Http\Controllers\BaseController\Department;

use App\Http\Controllers\Controller;
use App\Http\Requests\BaseRequest\Department\StoreEmployeeDepartmentRequest;
use App\Http\Requests\BaseRequest\Department\UpdateEmployeeDepartmentRequest;
use App\Http\Resources\BaseResource\Department\EmployeeDepartmentResource;
use App\Http\Resources\BaseResource\Department\EmployeeDepartmentResourceCollection;
use App\Models\BaseModel\Department\Department;
use App\Models\BaseModel\Department\EmployeeDepartment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmployeeDepartmentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(EmployeeDepartment::class, 'edep');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() : Response
    {
        return response(new EmployeeDepartmentResourceCollection(EmployeeDepartment::all()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreEmployeeDepartmentRequest $request
     * @return Response
     */
    public function store(StoreEmployeeDepartmentRequest $request): Response
    {
        EmployeeDepartment::create($request->validated());
        return \response(['message' => 'Отделение создано']);
    }

    /**
     * Display the specified resource.
     *
     * @param EmployeeDepartment $edep
     * @return Response
     */
    public function show(EmployeeDepartment $edep) : Response
    {
        return response(new EmployeeDepartmentResource($edep));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateEmployeeDepartmentRequest $request
     * @param EmployeeDepartment $edep
     * @return Response
     */
    public function update(UpdateEmployeeDepartmentRequest $request, EmployeeDepartment $edep): Response
    {
        $edep->update($request->validated());
        return response(['message' => 'Отделение обновлено']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param EmployeeDepartment $edep
     * @return Response
     */
    public function destroy(EmployeeDepartment $edep): Response
    {
        $this->authorize('delete', $edep);
        $edep->delete();
        return \response(['message' => 'Отделение удалено']);
    }
}
