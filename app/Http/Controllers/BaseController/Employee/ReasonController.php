<?php

namespace App\Http\Controllers\BaseController\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\BaseRequest\Employee\StoreReasonRequest;
use App\Http\Requests\BaseRequest\Employee\UpdateReasonRequest;
use App\Http\Resources\BaseResource\Employee\ReasonResource;
use App\Http\Resources\BaseResource\Employee\ReasonResourceCollection;
use App\Models\BaseModel\Employee\Reason;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReasonController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(Reason::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        return response(new ReasonResourceCollection(Reason::all()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreReasonRequest $request
     * @return Response
     */
    public function store(StoreReasonRequest $request): Response
    {
        Reason::create($request->validated());
        return \response(['message' => 'Причина успешно создана']);
    }

    /**
     * Display the specified resource.
     *
     * @param Reason $reason
     * @return Response
     */
    public function show(Reason $reason): Response
    {
        return \response(new ReasonResource($reason));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateReasonRequest $request
     * @param Reason $reason
     * @return Response
     */
    public function update(UpdateReasonRequest $request, Reason $reason): Response
    {
        $reason->update($request->validated());
        return response(['message' => 'Причина успешно обновлена']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Reason $reason
     * @return Response
     */
    public function destroy(Reason $reason): Response
    {
        $reason->delete();
        return \response(['message' => 'Причина удалена']);
    }
}
