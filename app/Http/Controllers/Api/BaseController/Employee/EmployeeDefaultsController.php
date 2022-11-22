<?php

namespace App\Http\Controllers\Api\BaseController\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BaseRequest\Employee\EmployeeDefaultsRequest;
use App\Http\Resources\Api\BaseResource\Employee\EmployeeDefaultResource;
use App\Models\BaseModels\Employees\Employee;
use App\Models\BaseModels\Employees\EmployeeDefaults;
use App\Models\BaseModels\Employees\Reason;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class EmployeeDefaultsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(EmployeeDefaults::class, 'defaults');
    }

    public function assignDefault(EmployeeDefaultsRequest $request, Reason $reason): Response|Application|ResponseFactory
    {
        $employee = Employee::find($request->employee_id);
        if ($employee == null) {
            return response(['message' => 'Такой пользователь не найден'], 404);
        }
        if ($request->from_date > $request->to_date) {
            return response(['message' => 'Ошибка указания даты'], 400);
        }
        if (!$employee->isOnWork()) {
            return response(['message' => 'Сотруднику уже назначено отстутсвие'], 400);
        }
        $default = new EmployeeDefaults($request->validated());
        $default->save();
        return response($default, 201);
    }

    public function viewDefault(Employee $employee): Response|Application|ResponseFactory
    {
        if ($employee->isOnWork()) return response(['message' => 'Отсутствий не найдено'], 404);
        return response(new EmployeeDefaultResource($employee->lastDefault()));
    }

    public function cancelDefault(EmployeeDefaults $employeeDefaults): Response|Application|ResponseFactory
    {
        $employeeDefaults->delete();
        return response(['message'=> 'Причина удалена']);
    }
}
