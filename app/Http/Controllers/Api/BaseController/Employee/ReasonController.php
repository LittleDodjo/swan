<?php

namespace App\Http\Controllers\Api\BaseController\Employee;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\BaseResource\Employee\ReasonResource;
use App\Http\Resources\Api\BaseResource\Employee\ReasonResourceCollection;
use App\Models\BaseModels\Employees\Reason;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReasonController extends Controller
{

    public function __construct(){
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
        return response()->json(
            new ReasonResourceCollection(
                new ReasonResource(
                    Reason::all()
                )
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'caption' => 'required|string',
            'is_always' => 'required|boolean',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 404);
        }
        $reason = new Reason($validator->validated());
        $reason->save();
        return response()->json(['message' => 'Причина успешно создана'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BaseModels\Employees\Reason  $reason
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Reason $reason)
    {
        if ($reason == null) {
            return response()->json(['message' => 'Такая причина не найдена'], 404);
        }
        return response()->json(new ReasonResource($reason));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BaseModels\Employees\Reason  $reason
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reason $reason)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BaseModels\Employees\Reason  $reason
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Reason $reason)
    {
        if ($reason == null) {
            return response()->json(['message' => 'Такая причина не найдена'], 404);
        }
        $reason->delete();
        return response()->json(['message' => 'Причина успешно удалена']);
    }
}
