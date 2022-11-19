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

    public function newReason(Request $request)
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

    public function deleteReason(Request $request, $id)
    {
        $reason = Reason::find($id);
        if ($reason == null) {
            return response()->json(['message' => 'Такая причина не найдена'], 404);
        }
        $reason->delete();
        return response()->json(['message' => 'Причина успешно удалена']);
    }

    public function viewReason(Request $request, $id)
    {
        $reason = Reason::find($id);
        if ($reason == null) {
            return response()->json(['message' => 'Такая причина не найдена'], 404);
        }
        return response()->json(new ReasonResource($reason));
    }

    public function viewAllReasons(Request $request)
    {
        return response()->json(
            new ReasonResourceCollection(
                new ReasonResource(
                    Reason::all()
                )
            )
        );
    }

}
