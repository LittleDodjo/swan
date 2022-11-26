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

    /**
     * Создать причину отсутсвия
     * @param EmployeeDefaultsRequest $request
     * @param Reason $reason
     * @return Response|Application|ResponseFactory
     */
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
        $default = EmployeeDefaults::create(
            array_merge($request->validated(), ['reason_id' => $reason->id]));
        return response([$default], 201);
    }

    /**
     * Посмотреть причину отсуствия (отправляет ответ последней актуальной причины)?
     * Если причины не найдено, отправляет 400
     * @param Employee $employee
     * @return Response|Application|ResponseFactory
     */
    public function viewDefault(Employee $employee): Response|Application|ResponseFactory
    {
        if ($employee->isOnWork()) return response(['message' => 'Отсутствий не найдено'], 400);
        return response(new EmployeeDefaultResource($employee->lastDefault()));
    }


    public function viewAllDefaults(Employee $employee)
    {
        return response(new EmployeeDefaultResource($employee->employeeDefault()));
    }

    /**
     * Удалить причину отсуствия
     * @param EmployeeDefaults $default
     * @return Response|Application|ResponseFactory
     */
    public function cancelDefault(EmployeeDefaults $default): Response|Application|ResponseFactory
    {
        $default->delete();
        return response(['message' => 'Причина удалена']);
    }
}
