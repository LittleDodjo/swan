<?php

namespace App\Http\Controllers\Api\BaseController\Employee;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\BaseResource\Employee\EmployeeDefaultResource;
use App\Models\BaseModels\Employees\Employee;
use App\Models\BaseModels\Employees\EmployeeDefaults;
use App\Models\BaseModels\Employees\Reason;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeDefaultsController extends Controller
{
    public function assignDefault(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required',
            'reason_id' => 'required',
            'fromDate' => 'required|date',
            'toDate' => 'required|date',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        if (Employee::find($request->all()['employee_id']) == null) {
            return response()->json(['message' => 'Такой пользователь не найден'], 404);
        }
        $reason = Reason::find($request->all()['reason_id']);
        if ($reason == null) {
            return response()->json(['message' => 'Такой причины не найдено'], 404);
        }
        $default = new EmployeeDefaults($validator->validated());
        $default->reason_id = $reason->id;
        $default->save();
        return response()->json($default);
    }

    public function viewDefault($id)
    {
        $default = EmployeeDefaults::find($id);
        if($default == null){
            return response()->json(['message' => 'Отсутствие сотрудника не найдено'], 404);
        }
        return response()->json(new EmployeeDefaultResource($default));
    }

    public function cancelDefault(Request $request)
    {

    }
}
