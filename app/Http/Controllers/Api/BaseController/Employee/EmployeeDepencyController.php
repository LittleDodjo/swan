<?php

namespace App\Http\Controllers\Api\BaseController\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BaseRequest\Employee\EmployeeDepencyRequest;
use App\Models\BaseModels\Employees\Employee;
use App\Models\BaseModels\Employees\EmployeeDepency;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Validator;

class EmployeeDepencyController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:api');
//        $this->authorizeResource(EmployeeDepency::class, 'employees');
    }

    /**
     * Посмотреть все зависимости сотрудника
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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
        return response(new EmployeeDepencyResource($employee->employeeDepency));
    }

    /**
     * Создать зависимость сотрудника к сотруднику
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeDepencyRequest $request)
    {
        $dependsEmployee = Employee::find($request->employee_id); // Зависимый сотрудник
        $employeePrimary = Employee::find($request->employee_depends_id); // Ведомый сотрудник
        if ($dependsEmployee == null || $employeePrimary == null) {
            return response(['message' => 'Такой сотрудник не найден'], 404);
        }
        if ($employeePrimary->is($dependsEmployee)) {
            return response(['message' => 'Нельзя установить зависимость самому сотруднику'], 422);
        }
        if (!$this->checkRank($dependsEmployee->rank, $employeePrimary->rank)) {
            return response(['message' => 'Нельзя выполнить привязку'], 422);
        }
        $dependsEmployee->employeeDepency->update(['employee_id' => $employeePrimary->id]);
        return response([
            'message' => 'Зависимость успешно создана',
        ], 221);
    }

    /**
     * Посмотреть зависимость сотрудника к сотруднику
     *
     * @param \App\Models\BaseModels\Employees\EmployeeDepency $employeeDepency
     * @return \Illuminate\Http\Response response
     */
    public function show(EmployeeDepency $employee)
    {
        return response(new ShortEmployeeDepencyResource($employee));
    }

    /**
     * Изменить зависимость сотрудника к сотруднику
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BaseModels\Employees\EmployeeDepency $employeeDepency
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeDepencyRequest $request, EmployeeDepency $employeeDepency)
    {
        $dependsEmployee = Employee::find($request->employee_id); // Зависимый сотрудник
        $employeePrimary = Employee::find($request->employee_depends_id); // Ведомый сотрудник
        if ($dependsEmployee == null || $employeePrimary == null) {
            return response(['message' => 'Такой сотрудник не найден'], 404);
        }
        if ($employeePrimary->is($dependsEmployee)) {
            return response(['message' => 'Нельзя установить зависимость самому сотруднику'], 422);
        }
        if (!$this->checkRank($dependsEmployee->rank, $employeePrimary->rank)) {
            return response(['message' => 'Нельзя выполнить привязку'], 422);
        }
        $dependsEmployee->employeeDepency->update(['employee_id' => $employeePrimary->id]);
        return response(['message' => 'Зависимость успешно изменена']);
    }

    /**
     * Удалить зависимость сотрудника к сотруднику
     *
     * @param \App\Models\BaseModels\Employees\EmployeeDepency $employeeDepency
     * @return \Illuminate\Http\Response response
     */
    public function destroy(EmployeeDepency $employeeDepency)
    {
        $employeeDepency->update(['employee_id' => null]);
        return response(['message' => 'Зависимость удалена']);
    }


    /**
     * Говнокод который потом исправлю... когда-то...
     * @param $employeeDependsRank
     * @param $employeePrimaryRank
     * @return bool
     */
    private function checkRank($employeeDependsRank, $employeePrimaryRank)
    {
        if ($employeeDependsRank == 7) return false;
        if ($employeeDependsRank == 6 && $employeePrimaryRank == 7) return true;
        if ($employeeDependsRank == 5 && $employeePrimaryRank == 7) return true;
        if ($employeeDependsRank == 4 && ($employeePrimaryRank == 5 || $employeePrimaryRank == 6)) return true;
        if ($employeeDependsRank == 3 && ($employeePrimaryRank == 4 || $employeePrimaryRank == 5 || $employeePrimaryRank == 6 || $employeePrimaryRank == 7)) return true;
        if ($employeeDependsRank == 2 && $employeePrimaryRank == 3) return true;
        if ($employeeDependsRank == 1 && ($employeePrimaryRank == 2 || $employeePrimaryRank == 3)) return true;
        return false;
    }
}
