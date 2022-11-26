<?php

namespace App\Http\Controllers\BaseController\Management;

use App\Http\Controllers\Controller;
use App\Http\Requests\BaseRequest\Management\StoreManagementRequest;
use App\Http\Requests\BaseRequest\Management\UpdateManagementRequest;
use App\Http\Resources\BaseResource\Management\ManagementResource;
use App\Http\Resources\BaseResource\Management\ManagementResourceCollection;
use App\Models\BaseModel\Management\Management;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ManagementController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        return response(new ManagementResourceCollection(Management::all()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreManagementRequest $request
     * @return Response
     */
    public function store(StoreManagementRequest $request): Response
    {
        Management::create($request->validated());
        return \response(['message' => 'Управление создано']);
    }

    /**
     * Display the specified resource.
     *
     * @param Management $management
     * @return Response
     */
    public function show(Management $management): Response
    {
        return \response(new ManagementResource($management));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateManagementRequest $request
     * @param Management $management
     * @return Response
     */
    public function update(UpdateManagementRequest $request, Management $management): Response
    {
        $management->update($request->validated());
        return response(['message' => 'Управление успешно изменено']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Management $management
     * @return Response
     */
    public function destroy(Management $management): Response
    {
        $management->delete();
        return response(['message' => 'Управление удалено']);
    }
}
