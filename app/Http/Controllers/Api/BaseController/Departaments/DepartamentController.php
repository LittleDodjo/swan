<?php

namespace App\Http\Controllers\Api\BaseController\Departaments;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\BaseResource\AllDepartamentResource;
use App\Http\Resources\Api\BaseResource\AllDepartamentResourceCollection;
use App\Http\Resources\Api\BaseResource\Departament\DepartamentEmployeesResource;
use App\Http\Resources\Api\BaseResource\Departament\DepartamentResource;
use App\Http\Resources\Api\BaseResource\Pivots\DepartamentsToManagmentResourceCollection;
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

    public function viewAllDepartaments(Request $request)
    {
        $registry = new AllDepartamentResourceCollection(
            new AllDepartamentResource(
                AllDepartaments::all()
            )
        );
        return response()->json($registry);
    }

    public function viewManagmentDepartaments(Request $request, $id)
    {
        $managment = Managment::find($id);
        if ($managment == null) {
            return response()->json(['message' => 'Такое управление не найдено'], 404);
        }
        $deps = new DepartamentsToManagmentResourceCollection(
            $managment->departaments
        );

        return response()->json(
            ['data' => $deps], 200
        );
    }

    public function viewEmployeeDepartaments()
    {

    }


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
            new DepartamentEmployeesResource($departament)
        );
    }

    public function updateDepency()
    {

    }

    public function updatePrimaryManager()
    {

    }

    public function updateManager()
    {

    }

    public function updateCode()
    {

    }

    public function updateCaption()
    {

    }

    public function updateShortName()
    {

    }

    private function appendDepency($pivotModel, $pivotKey, $departamentKey, $departamentId, $dependsId)
    {
        $model = new $pivotModel();
        $model->$pivotKey = $dependsId;
        $model->$departamentKey = $departamentId;
        $model->save();
        return $model;
    }

    private function appendEmployee($pivotModel, $pivotKey, $departamentId, $employeeId)
    {
        $model = new $pivotModel();
        $model->$pivotKey = $departamentId;
        $model->employee_id = $employeeId;
        $model->save();
        return $model;
    }

    private function appendRegistry($key, $id)
    {
        $registry = new AllDepartaments();
        $registry->$key = $id;
        $registry->save();
        return $registry;
    }

}
