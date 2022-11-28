<?php

namespace App\Http\Controllers\BaseController\Department;

use App\Http\Controllers\Controller;
use App\Http\Requests\BaseRequest\Department\StoreDepartmentRequest;
use App\Http\Requests\BaseRequest\Department\UpdateDepartmentRequest;
use App\Http\Resources\BaseResource\Department\DepartmentResource;
use App\Http\Resources\BaseResource\Department\DepartmentResourceCollection;
use App\Models\BaseModel\Department\Department;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DepartmentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(Department::class,'mdep');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        return response(new DepartmentResourceCollection(Department::all()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreDepartmentRequest $request
     * @return Response
     */
    public function store(StoreDepartmentRequest $request): Response
    {
        Department::create($request->validated());
        return response([$request->validated()]);
    }

    /**
     * Display the specified resource.
     *
     * @param Department $mdep
     * @return Response
     */
    public function show(Department $mdep): Response
    {
        return response(new DepartmentResource($mdep));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateDepartmentRequest $request
     * @param Department $mdep
     * @return Response
     */
    public function update(UpdateDepartmentRequest $request, Department $mdep): Response
    {
        $mdep->update($request->validated());
        return response($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Department $mdep
     * @return Response
     */
    public function destroy(Department $mdep): Response
    {
        $mdep->delete();
        return response(['message' => 'Отделение удалено']);
    }
}
