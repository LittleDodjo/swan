<?php

namespace App\Http\Controllers\Api\BaseController\Departaments;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\BaseResource\AllDepartamentResource;
use App\Http\Resources\Api\BaseResource\AllDepartamentResourceCollection;
use App\Http\Resources\Api\BaseResource\Departament\DepartamentEmployeesResource;
use App\Http\Resources\Api\BaseResource\Departament\DepartamentResource;
use App\Http\Resources\Api\BaseResource\Employee\EmployeeResource;
use App\Http\Resources\Api\BaseResource\Pivots\DepartamentsToManagmentResourceCollection;
use App\Http\Resources\Api\BaseResource\Pivots\EmployeesToDepartamentResource;
use App\Http\Resources\Api\BaseResource\Pivots\EmployeesToDepartamentResourceCollection;
use App\Models\BaseModels\AllDepartaments;
use App\Models\BaseModels\Departaments\Departament;
use App\Models\BaseModels\Departaments\EmployeeDepartament;
use App\Models\BaseModels\Employees\Employee;
use App\Models\BaseModels\Managments\Managment;
use App\Models\BaseModels\Pivots\DepartamentsToManagment;
use App\Models\BaseModels\Pivots\EmployeeDepartamentsToEmployee;
use App\Models\BaseModels\Pivots\EmployeesToDepartament;
use App\Models\BaseModels\Pivots\EmployeesToEmployeeDepartament;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;


class DepartamentController extends Controller
{

    public $config = [
        'mdep' => [
            'model' => Departament::class,
            'depends_model' => Managment::class,
            'depends_key' => 'managment_depends',
            'pivot_model' => DepartamentsToManagment::class,
            'pivot_key' => 'managment_id',
            'departament_key' => 'departament_id',
            'employees_model' => EmployeesToDepartament::class,
            'employees_key' => 'departament_id',
        ],
        'edep' => [
            'model' => EmployeeDepartament::class,
            'depends_model' => Employee::class,
            'depends_key' => 'employee_depends',
            'pivot_model' => EmployeeDepartamentsToEmployee::class,
            'pivot_key' => 'employee_id',
            'departament_key' => 'employee_departament_id',
            'employees_model' => EmployeesToEmployeeDepartament::class,
            'employees_key' => 'employee_departament_id',
        ],
    ];

    public function __construct()
    {
//        $this->middleware('auth:api');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     * Создать новое отделение, указава его тип
     */
    public function newDepartament(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'caption' => 'required|string',
            'short_name' => 'required|string',
            'display_number' => 'required|string',
            'employee_primary_manager_id' => 'required|integer',
            'type' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $type = $request->all()['type'];
        $model = $this->config[$type]['model'];
        $key = $this->config[$type]['depends_key'];
        $departament = new $model(
            $validator->validated()
        );
        $departament->$key = $request->all()[$key];
        $departament->save();
        $depency = $this->appendDepency(
            $this->config[$type]['pivot_model'],
            $this->config[$type]['pivot_key'],
            $this->config[$type]['departament_key'],
            $departament->id,
            $request->all()[$key]
        );
        $append = $this->appendEmployee(
            $this->config[$type]['employees_model'],
            $this->config[$type]['employees_key'],
            $departament->id,
            $request->all()['employee_primary_manager_id']
        );
        $registry = $this->appendRegistry($this->config[$type]['employees_key'], $departament->id);
        return response()->json([
            $departament,
            $depency,
            $append,
            $registry,
        ], 200);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * Удалить существующее отделение
     */
    public function deleteDepartament(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $type = $request->all()['type'];
        $model = $this->config[$type]['model'];
        $departament = $model::find($id);
        if ($departament == null) {
            return response()->json(
                ['message' => 'Такой отдел не найден'], 404
            );
        }
        $registryKey = $this->config[$type]['employees_key'];
        $pivotKey = $this->config[$type]['departament_key'];
        $pivotModel = $this->config[$type]['pivot_model'];
        $registry = AllDepartaments::where($registryKey, $id)->first();
        $pivot = $pivotModel::where($pivotKey, $departament->id)->first();
        $registry->delete();
        $pivot->delete();
        $departament->delete();
        return response()->json(
            ['message' => 'Отдел удален', $registry, $departament, $pivot, $pivotModel, $pivotKey, $departament->id], 200
        );
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * Посмотреть все отделения
     */
    public function viewAllDepartaments(Request $request)
    {
        $registry = new AllDepartamentResourceCollection(
            new AllDepartamentResource(
                AllDepartaments::all()
            )
        );
        return response()->json($registry);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * Посмотреть отделение
     */
    public function viewDepartament(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $type = $request->all()['type'];
        $model = $this->config[$type]['model'];
        $departament = $model::find($id);
        if ($departament == null) {
            return response()->json(
                ['message' => 'Такой отдел не найден'], 404
            );
        }
        return response()->json(new DepartamentResource($departament), 200);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * Посмотреть сотрудников отделения
     */
    public function viewEmployees(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $type = $request->all()['type'];
        $model = $this->config[$type]['model'];
        $departament = $model::find($id);
        if ($departament == null) {
            return response()->json(
                ['message' => 'Такой отдел не найден'], 404
            );
        }
        return response()->json(
            new EmployeesToDepartamentResourceCollection(
                new EmployeesToDepartamentResource(
                    $departament->employees
                )
            )
        );
    }

    public function assignNewEmployee(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|string',
            'employee_id' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 404);
        }
        $type = $request->all()['type'];
        $model = $this->config[$type]['model'];
        $departament = $model::find($id);
        if ($departament == null) {
            return response()->json(
                ['message' => 'Такой отдел не найден'], 404
            );
        }
        $data = Employee::find($id);
        if ($data == null) {
            return response()->json(['message' => 'Такой сотрудник не найден'], 404);
        }
        $append = $this->appendEmployee(
            $this->config[$type]['employees_model'],
            $this->config[$type]['employees_key'],
            $departament->id,
            $request->all()['employee_id']
        );
        return response()->json(['message' => 'Сотрудник успешно добавлен в отдел']);
    }

    public function removeAssign(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|string',
            'employee_id' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 404);
        }
        $type = $request->all()['type'];
        $model = $this->config[$type]['employees_model'];
        $departament = $model::find($id);
        if ($departament == null) {
            return response()->json(
                ['message' => 'Такой отдел не найден'], 404
            );
        }
        $data = Employee::find($id);
        if ($data == null) {
            return response()->json(['message' => 'Такой сотрудник не найден'], 404);
        }
        $pivot = $model::where('employee_id', $request->all()['employee_id'])->first();
        if ($pivot == null) return response()->json(['message' => 'Такого сотрудника нет в этом отделе'], 404);
        $pivot->delete();
        return response()->json(['message' => 'Сотрудник удален из отдела']);
    }

    public function updateDepency(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|string',
            'employee_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 404);
        }

    }

    public function updatePrimaryManager(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|string',
            'employee_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 404);
        }
        if (Employee::find($request->all()['employee_id']) == null) {
            return response()->json('такой сотрудник не найден', 404);
        }
        $type = $request->all()['type'];
        $eModel = $this->config[$type]['employees_model'];
        $model = $this->config[$type]['pivot_model'];
        $pivotKey = $this->config[$type]['departament_key'];
        $departament = $model::find($id);
        if ($departament == null) {
            return response()->json('Не найдено', 404);
        }
        $departament = $departament->departament;
        $pivotEmployees = $eModel::find($request->all()['employee_id']);
        if ($departament->employee_primary_manager_id == $request->all()['employee_id']) {
            return response()->json('Данного сотрудника нельзя назначить на должность заместителя', 400);
        }
        if ($pivotEmployees == null) {
            $append = $this->appendEmployee(
                $this->config[$type]['employees_model'],
                $this->config[$type]['employees_key'],
                $departament->id,
                $request->all()['employee_id']
            );
        }
        $om = $eModel::where('employee_id', $departament->employee_primary_manager_id);
        $om->delete();
        $departament->employee_primary_manager_id = $request->all()['employee_id'];
        $departament->save();
        return response()->json([$departament]);
    }

    public function updateManager(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|string',
            'employee_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 404);
        }
        if (Employee::find($request->all()['employee_id']) == null) {
            return response()->json('такой сотрудник не найден', 404);
        }
        $type = $request->all()['type'];
        $eModel = $this->config[$type]['employees_model'];
        $model = $this->config[$type]['pivot_model'];
        $pivotKey = $this->config[$type]['departament_key'];
        $departament = $model::find($id);
        if ($departament == null) {
            return response()->json('Не найдено', 404);
        }
        $departament = $departament->departament;
        $pivotEmployees = $eModel::find($request->all()['employee_id']);
        if ($departament->employee_primary_manager_id == $request->all()['employee_id']) {
            return response()->json('Данного сотрудника нельзя назначить на должность заместителя', 400);
        }
        if ($pivotEmployees == null) {
            $append = $this->appendEmployee(
                $this->config[$type]['employees_model'],
                $this->config[$type]['employees_key'],
                $departament->id,
                $request->all()['employee_id']
            );
        }
        if ($departament->employee_manager_id != null) {
            $om = $eModel::where('employee_id', $departament->employee_manager_id);
            $om->delete();
        }
        $departament->employee_manager_id = $request->all()['employee_id'];
        $departament->save();
        return response()->json([$departament]);
    }

    public function updateCode(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|string',
            'code' => 'required|string|min:2',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 404);
        }
        $type = $request->all()['type'];
        $model = $this->config[$type]['employees_model'];
        $departament = $model::find($id);
        if ($departament == null) {
            return response()->json(
                ['message' => 'Такой отдел не найден'], 404
            );
        }
        $departament->display_number = $request->all()['code'];
        $departament->save();
        return response()->json(['message' => 'Код отдела изменен успешно']);
    }

    public function updateCaption(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|string',
            'caption' => 'required|string|min:2',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 404);
        }
        $type = $request->all()['type'];
        $model = $this->config[$type]['employees_model'];
        $departament = $model::find($id);
        if ($departament == null) {
            return response()->json(
                ['message' => 'Такой отдел не найден'], 404
            );
        }
        $departament->caption = $request->all()['short_name'];
        $departament->save();
        return response()->json(['message' => 'Имя отдела изменено успешно']);
    }

    public function updateShortName(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|string',
            'short_name' => 'required|string|min:2',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 404);
        }
        $type = $request->all()['type'];
        $model = $this->config[$type]['employees_model'];
        $departament = $model::find($id);
        if ($departament == null) {
            return response()->json(
                ['message' => 'Такой отдел не найден'], 404
            );
        }
        $departament->short_name = $request->all()['short_name'];
        $departament->save();
        return response()->json(['message' => 'Короткое имя отдела изменено успешно']);
    }

    /**
     * @param $pivotModel
     * @param $pivotKey
     * @param $departamentKey
     * @param $departamentId
     * @param $dependsId
     * @return mixed
     * Установить зависимость отдела к сводной модели
     */
    private function appendDepency($pivotModel, $pivotKey, $departamentKey, $departamentId, $dependsId)
    {
        $model = new $pivotModel();
        $model->$pivotKey = $dependsId;
        $model->$departamentKey = $departamentId;
        $model->save();
        return $model;
    }

    /**
     * @param $pivotModel
     * @param $pivotKey
     * @param $departamentId
     * @param $employeeId
     * @return mixed     *
     * Добавить нового сотрудника к отделу
     */
    private function appendEmployee($pivotModel, $pivotKey, $departamentId, $employeeId)
    {
        $model = new $pivotModel();
        $model->$pivotKey = $departamentId;
        $model->employee_id = $employeeId;
        $model->save();
        return $model;
    }

    /**
     * @param $key
     * @param $id
     * @return AllDepartaments
     * Добавить отдел в реестр отделов
     */
    private function appendRegistry($key, $id)
    {
        $registry = new AllDepartaments();
        $registry->$key = $id;
        $registry->save();
        return $registry;
    }

}
