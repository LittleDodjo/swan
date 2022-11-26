<?php

namespace App\Http\Controllers\Api\BaseController\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BaseRequest\Employee\ReasonRequest;
use App\Http\Resources\Api\BaseResource\Employee\ReasonResource;
use App\Http\Resources\Api\BaseResource\Employee\ReasonResourceCollection;
use App\Models\BaseModels\Employees\Reason;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(new ReasonResourceCollection(new ReasonResource(Reason::all())));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ReasonRequest $request
     * @return JsonResponse
     */
    public function store(ReasonRequest $request): JsonResponse
    {
        Reason::create($request->validated());
        return response()->json(['message' => 'Причина успешно создана'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Reason $reason
     * @return JsonResponse
     */
    public function show(Reason $reason): JsonResponse
    {
        return response()->json(new ReasonResource($reason));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Reason $reason
     * @return JsonResponse
     */
    public function update(ReasonRequest $request, Reason $reason): JsonResponse
    {
        $reason->update($request->validated());
        return response()->json(['message' => 'Причина успешно изменена']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Reason $reason
     * @return JsonResponse
     */
    public function destroy(Reason $reason): JsonResponse
    {
        $reason->delete();
        return response()->json(['message' => 'Причина успешно удалена']);
    }
}
