<?php

namespace App\Http\Controllers\Api\BaseController\Employee;

use App\Http\Controllers\Api\BaseProvider\DependencyProvider;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BaseRequest\Employee\EmployeeDecencyRequest;
use App\Http\Resources\Api\BaseResource\Employee\EmployeeDependencyResource;
use App\Http\Resources\Api\BaseResource\Employee\ShortEmployeeDependencyResource;
use App\Models\BaseModels\Employees\Employee;
use App\Models\BaseModels\Employees\EmployeeDependency;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class EmployeeDependencyController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:api');
//        $this->authorizeResource(EmployeeDependency::class, 'employees');
    }

    /**
     * Посмотреть все зависимости сотрудника
     * @param Request $request
     * @return Response
     * @noinspection PhpPossiblePolymorphicInvocationInspection
     */
    public function index(Request $request): Response
    {
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response($validator->errors(), 400);
        }
        $employee = Employee::find($request->employee_id);
        if ($employee == null) {
            return response(['message' => 'Такой сотрудник не найден'], 404);
        }
        return response(new EmployeeDependencyResource($employee->employeeDependency));
    }

    /**
     * Создать зависимость сотрудника к сотруднику
     *
     * @param EmployeeDecencyRequest $request
     * @return Response
     */
    public function store(EmployeeDecencyRequest $request): Response
    {
        $dependsEmployee = Employee::find($request->employee_id); // Зависимый сотрудник
        $employeePrimary = Employee::find($request->employee_depends_id); // Ведомый сотрудник
        if ($dependsEmployee == null || $employeePrimary == null) {
            return response(['message' => 'Такой сотрудник не найден'], 404);
        }
        if ($employeePrimary->is($dependsEmployee)) {
            return response(['message' => 'Нельзя установить зависимость самому сотруднику'], 422);
        }
        if (!DependencyProvider::checkEmployeeDependency($dependsEmployee->rank, $employeePrimary->rank)) {
            return response(['message' => 'Нельзя выполнить привязку'], 422);
        }
        $dependsEmployee->employeeDependency->update(['employee_id' => $employeePrimary->id]);
        return response(['message' => 'Зависимость успешно создана',], 201);
    }

    /**
     * Посмотреть зависимость сотрудника к сотруднику
     *
     * @param EmployeeDependency $employee
     * @return Response response
     */
    public function show(EmployeeDependency $employee): Response
    {
        return response(new ShortEmployeeDependencyResource($employee));
    }

    /**
     * Изменить зависимость сотрудника к сотруднику
     *
     * @param EmployeeDecencyRequest $request
     * @param EmployeeDependency $employee
     * @return Response
     */
    public function update(EmployeeDecencyRequest $request, EmployeeDependency $employee): Response
    {
        $dependsEmployee = Employee::find($request->employee_id); // Зависимый сотрудник
        $employeePrimary = Employee::find($request->employee_depends_id); // Ведомый сотрудник
        if ($dependsEmployee == null || $employeePrimary == null) {
            return response(['message' => 'Такой сотрудник не найден'], 404);
        }
        if ($employeePrimary->is($dependsEmployee)) {
            return response(['message' => 'Нельзя установить зависимость самому сотруднику'], 422);
        }
        if (!DependencyProvider::checkEmployeeDependency($dependsEmployee->rank, $employeePrimary->rank)) {
            return response(['message' => 'Нельзя выполнить привязку'], 422);
        }
        $dependsEmployee->employeeDependency->update(['employee_id' => $employeePrimary->id]);
        return response(['message' => 'Зависимость успешно изменена']);
    }

    /**
     * Удалить зависимость сотрудника к сотруднику
     *
     * @param EmployeeDependency $employee
     * @return Response response
     */
    public function destroy(EmployeeDependency $employee): Response
    {
        $employee->update(['employee_id' => null]);
        return response(['message' => 'Зависимость удалена']);
    }
}
