<?php

namespace App\Http\Controllers\Api\BaseController\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BaseRequest\Employee\EmployeeDefaultsRequest;
use App\Http\Resources\Api\BaseResource\Employee\EmployeeDefaultResource;
use App\Models\BaseModels\Employees\Employee;
use App\Models\BaseModels\Employees\EmployeeDefaults;
use App\Models\BaseModels\Employees\Reason;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeDefaultsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(EmployeeDefaults::class, 'defaults');
    }

    public function assignDefault(EmployeeDefaultsRequest $request, Reason $reason)
    {
        $employee = Employee::find($request->employee_id);
        if ($employee == null) {
            return response(['message' => 'Такой пользователь не найден'], 404);
        }
        if ($request->fromDate > $request->toDate) {
            return response(['message' => 'Ошибка указания даты'], 400);
        }
        if (!$employee->isOnWork()) {
            return response(['message' => 'Сотруднику уже назначено отстутсвие'], 400);
        }
        $default = new EmployeeDefaults($request->validated());
        $default->save();
        return response($default, 201);
    }

    public function viewDefault(Employee $employee)
    {
        if ($employee->isOnWork()) return response(['message' => 'Отсутствий не найдено'], 404);
        return response(new EmployeeDefaultResource($employee->lastDefault()));
    }

    public function cancelDefault(EmployeeDefaults $employeeDefaults)
    {
        $employeeDefaults->delete();
        return response(['message'=> 'Причина удалена']);
    }
}
