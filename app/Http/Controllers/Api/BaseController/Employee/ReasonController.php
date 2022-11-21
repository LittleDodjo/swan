<?php

namespace App\Http\Controllers\Api\BaseController\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BaseRequest\Employee\ReasonRequest;
use App\Http\Resources\Api\BaseResource\Employee\ReasonResource;
use App\Http\Resources\Api\BaseResource\Employee\ReasonResourceCollection;
use App\Models\BaseModels\Employees\Reason;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReasonController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(Reason::class, 'reason');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(new ReasonResourceCollection(new ReasonResource(Reason::all())));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ReasonRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ReasonRequest $request)
    {
        Reason::create($request->validated());
        return response()->json(['message' => 'Причина успешно создана'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\BaseModels\Employees\Reason $reason
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Reason $reason)
    {
        return response()->json(new ReasonResource($reason));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BaseModels\Employees\Reason $reason
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ReasonRequest $request, Reason $reason)
    {
        $reason->update($request->validated());
        return response()->json(['message' => 'Причина успешно изменена']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\BaseModels\Employees\Reason $reason
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Reason $reason)
    {
        $reason->delete();
        return response()->json(['message' => 'Причина успешно удалена']);
    }
}
